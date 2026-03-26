<?php

namespace App\Http\Controllers;

use App\Models\admin\AdminTryout;
use App\Models\Beranda;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\StreakCharacter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\XpService;

class BerandaController extends Controller
{
    public function index()
{
    $setting = Setting::first();
    $snbtDate = $setting->snbt_date ?? null;

    $now = Carbon::now();
    $user = Auth::user();

   $xpService = new XpService();


// 🔥 SYNC STATUS DULU
$xpService->checkStreakExpired($user);

// 🔥 BARU AMBIL KARAKTER
$character = $xpService->getCurrentCharacter($user);

    $tos = DB::table('admin_tryouts')
    ->where('is_active', true)
    ->orderBy('tanggal', 'desc')
    ->take(3)
    ->get()
    ->map(function ($to) use ($now, $user) {
        
        $sudahDikerjakan = DB::table('tryout_jawaban_peserta')
            ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
            ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
            ->where('tryout_jawaban_peserta.user_id', $user->id) // 🔥 FIX (tadi salah)
            ->where('tryout_categories.admin_tryout_id', $to->id)
            ->exists();

        $is_open = $to->tanggal <= $now && $to->tanggal_akhir >= $now;

        $hasTarget = DB::table('user_target_tryouts')
            ->where('user_id', $user->id) // 🔥 FIX juga
            ->exists();

        $to->sudah_dikerjakan = $sudahDikerjakan;
        $to->is_open = $is_open && !$sudahDikerjakan;
        $to->is_locked = !$hasTarget;

        return $to;
    });

    return view('beranda', compact('setting','snbtDate','tos', 'character'));
}
}