<?php

namespace App\Http\Controllers;

use App\Models\Streak;
use App\Services\XpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();
    $xpService = new XpService();

    // Cek apakah streak hangus
    $xpService->checkStreakExpired($user);

    // Ambil karakter evolusi
    // $character = $xpService->getCurrentCharacter($user);

    // Hitung XP hari ini
    $todayXp = \App\Models\UserXpLog::where('user_id',$user->id)
        ->whereDate('xp_date', now())
        ->sum('xp');

    return view('streak.index', compact(
        'user',
        // 'character',
        'todayXp'
    ));
}

public function restore()
{
    $user = Auth::user();
    $xpService = new \App\Services\XpService();

    $restored = $xpService->restoreStreak($user);

    if ($restored) {
        return back()->with('success','Streak berhasil dipulihkan!');
    }

    return back()->with('error','Pemulihan hanya bisa 1x per bulan.');
}
}