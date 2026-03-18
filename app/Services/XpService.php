<?php

namespace App\Services;

use App\Models\UserXpLog;
use App\Models\Character;
use App\Models\StreakCharacter;
use App\Models\StreakRestore;
use Carbon\Carbon;

class XpService
{
    const DAILY_MAX = 140;
    // const XP_PER_LEVEL = 200;

    public function addXp($user, $source, $amount)
    {
        $today = Carbon::today();

        // Cek sudah dapat dari source hari ini?
        $already = UserXpLog::where('user_id', $user->id)
            ->where('source', $source)
            ->whereDate('xp_date', $today)
            ->exists();

        if ($already) return false;

        // Hitung total hari ini
        $todayTotal = UserXpLog::where('user_id', $user->id)
            ->whereDate('xp_date', $today)
            ->sum('xp');

        if (($todayTotal + $amount) > self::DAILY_MAX) return false;

        // Simpan log
        UserXpLog::create([
            'user_id' => $user->id,
            'source' => $source,
            'xp' => $amount,
            'xp_date' => $today
        ]);


        // Tambah XP
        $user->total_xp += $amount;

        // Update level
        $user->level = $this->calculateLevel($user->total_xp);

        // Update streak
        $this->updateStreak($user);

        $user->save();

        return true;
    }

    private function updateStreak($user)
    {
        $today = Carbon::today();

        if (!$user->streak_active) return;

        if ($user->last_xp_date &&
            Carbon::parse($user->last_xp_date)->isYesterday()) {
            $user->streak_days++;
        } elseif (!$user->last_xp_date ||
            !Carbon::parse($user->last_xp_date)->isToday()) {
            $user->streak_days = 1;
        }

        $user->last_xp_date = $today;
    }

    public function checkStreakExpired($user)
{
    if (!$user->last_xp_date) return;

    $days = Carbon::parse($user->last_xp_date)
            ->diffInDays(now());

    if ($days >= 1) {

        // 🔥 RESET TOTAL
        $user->streak_days = 1;
        $user->streak_active = false;

        // XP reset
        $user->total_xp = 0;
        $user->level = 1;

        // 🔒 Lock karakter
        $user->character_locked = true;

        $user->save();
    }
}

    public function restoreStreak($user)
{
    if ($user->streak_active) return false;

    $month = now()->month;

    $used = StreakRestore::where('user_id', $user->id)
        ->whereMonth('restore_date', $month)
        ->exists();

    if ($used) return false;

    // Catat pemakaian
    StreakRestore::create([
        'user_id' => $user->id,
        'restore_date' => now()
    ]);

    // 🔥 RESTORE
    $user->streak_active = true;
    $user->streak_days = 1;
    $user->last_xp_date = now();

    // 🔓 Unlock karakter
    $user->character_locked = false;

    // (Optional) kasih XP awal biar ga terlalu kejam
    // $user->total_xp = 50;

    $user->save();

    return true;
}

    public function getCurrentCharacter($user)
{
    if ($user->character_locked) {
        return null; // atau return karakter default "locked"
    }

    return StreakCharacter::where('min_level', '<=', $user->level)
        ->orderByDesc('min_level')
        ->first();
}

    private function calculateLevel($xp)
{
    return floor($xp / 200) + 1;
}

public function getXpForNextLevel($user)
{
    return $user->level * 200;
}

public function getXpProgress($user)
{
    return [
        'xp' => $user->total_xp,
        'maxXp' => $user->level * 200
    ];
}

public function recalcLevel($user)
{
    $user->level = $this->calculateLevel($user->total_xp);
    $user->save();
}
}