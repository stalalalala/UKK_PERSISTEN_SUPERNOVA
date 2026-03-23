<?php

namespace App\Http\Controllers;

use App\Models\Streak;
use App\Models\StreakCharacter;
use App\Models\UserXpLog;
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

     $character = StreakCharacter::where('min_level', '<=', $user->level)
        ->orderByDesc('min_level')
        ->first();

    // Ambil karakter evolusi
    // $character = $xpService->getCurrentCharacter($user);

    // XP hari ini
    $todayXp = UserXpLog::where('user_id', $user->id)
        ->whereDate('xp_date', today())
        ->sum('xp');

    $targetXp = 140;

    $xpPercent = min(100, ($todayXp / $targetXp) * 100);

    // Hitung XP hari ini
    $todayXp = UserXpLog::where('user_id',$user->id)->whereDate('xp_date', now())->sum('xp');

    // cek aktivitas
    $loginDone = UserXpLog::where('user_id',$user->id)
        ->where('source','login')
        ->whereDate('xp_date', today())
        ->exists();

    $kuisDone = UserXpLog::where('user_id',$user->id)
        ->where('source','kuis')
        ->whereDate('xp_date', today())
        ->exists();

    $latihanDone = UserXpLog::where('user_id',$user->id)
        ->where('source','latihan')
        ->whereDate('xp_date', today())
        ->exists();

    $tryoutDone = UserXpLog::where('user_id',$user->id)
        ->where('source','tryout')
        ->whereDate('xp_date', today())
        ->exists();

        $userLevel = $user->level;

// Ambil karakter streak sesuai level
$currentStreak = StreakCharacter::where('min_level', '<=', $userLevel)
    ->orderByDesc('min_level') // ambil yang tertinggi <= level user
    ->first();

    // 2. TAMBAHKAN INI: Ambil karakter berikutnya (yang belum terbuka)
$nextEvolution = StreakCharacter::where('min_level', '>', $userLevel)
    ->orderBy('min_level', 'ASC')
    ->first();

    $userHasNextEvolution = false;

if ($nextEvolution) {
    $userHasNextEvolution = $userLevel >= $nextEvolution->min_level;
}

    return view('streak.index', compact(
        'user',
        'todayXp',
        'xpPercent',
        'loginDone',
        'kuisDone',
        'latihanDone',
        'tryoutDone',
        'userLevel',
        'currentStreak',
        'nextEvolution',
        'userHasNextEvolution',
        'character'
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