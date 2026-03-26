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
     $tos = AdminTryout::all();

    $now = Carbon::now();
    $user = Auth::user();

   $xpService = new XpService();


// 🔥 SYNC STATUS DULU
$xpService->checkStreakExpired($user);

// 🔥 BARU AMBIL KARAKTER
$character = $xpService->getCurrentCharacter($user);

    $latestTryouts = DB::table('admin_tryouts')
        ->where('is_active', true)
        ->orderBy('tanggal', 'desc')
        ->take(3)
        ->get()
        ->map(function ($to) use ($now, $user) {
            // cek sudah dikerjakan
            $sudahDikerjakan = DB::table('tryout_jawaban_peserta')
                ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
                ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
                ->where('tryout_jawaban_peserta.user_id', $user)
                ->where('tryout_categories.admin_tryout_id', $to->id)
                ->exists();

            // apakah TO bisa dibuka sekarang
            $is_open = $to->tanggal <= $now && $to->tanggal_akhir >= $now;

            // cek apakah user sudah pilih target
            $hasTarget = DB::table('user_target_tryouts')->where('user_id', $user)->exists();

            $to->sudah_dikerjakan = $sudahDikerjakan;
            $to->is_open = $is_open && !$sudahDikerjakan;
            $to->is_locked = !$hasTarget;

            return $to;
        });

    return view('beranda', compact('setting','snbtDate','latestTryouts','tos', 'character'));
}
}