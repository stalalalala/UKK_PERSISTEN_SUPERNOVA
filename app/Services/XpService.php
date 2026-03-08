<?php

namespace App\Services;

use App\Models\UserXpLog;
use App\Models\Character;
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

        if ($days >= 5) {
            $user->streak_days = 0;
            $user->streak_active = false;
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

        StreakRestore::create([
            'user_id' => $user->id,
            'restore_date' => now()
        ]);

        $user->streak_active = true;
        $user->streak_days = 1;
        $user->last_xp_date = now();
        $user->save();

        return true;
    }

    public function getCurrentCharacter($user)
    {
        // return Character::where('min_level', '<=', $user->level)
        //     ->orderByDesc('min_level')
        //     ->first();

        return null;
    }

    private function calculateLevel($xp)
{
    $level = 1;

    while ($xp >= ($level * 200)) {
        $xp -= ($level * 200);
        $level++;
    }

    return $level;
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
}