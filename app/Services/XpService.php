<?php

namespace App\Services;

use App\Models\UserXpLog;
use App\Models\Character;
use App\Models\StreakCharacter;
use App\Models\StreakRestore;
use Illuminate\Support\Facades\Log;
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

    $lastDate = Carbon::parse($user->last_xp_date)->startOfDay();
    $today = Carbon::today();

    $days = $lastDate->diffInDays($today);

  

    // 🔥 JANGAN reset kalau sudah pernah hangus
    if ($days < 5 || $user->character_locked) {
        return;
    }

    // 🔥 BACKUP (cuma kalau belum ada backup)
    $user->backup_xp = $user->total_xp;
$user->backup_streak_days = $user->streak_days;
$user->backup_level = $user->level;

    // 🔥 RESET
    $user->streak_days = 1;
    $user->streak_active = false;
    $user->total_xp = 0;
    $user->level = 1;
    $user->character_locked = true;

    $user->save();
}

    public function restoreStreak($user)
{
    if ($user->streak_active) return false;

    // ❗ WAJIB: cuma bisa restore kalau lagi ke-lock
    if (!$user->character_locked) return false;

    $month = now()->month;
    $year = now()->year;

    $used = StreakRestore::where('user_id', $user->id)
        ->whereMonth('restore_date', $month)
        ->whereYear('restore_date', $year)
        ->exists();

    // 🔥 CATAT PEMAKAIAN
    StreakRestore::create([
        'user_id' => $user->id,
        'restore_date' => now()
    ]);

    UserXpLog::where('user_id', $user->id)
    ->where('source', 'login')
    ->whereDate('xp_date', today())
    ->delete();

    if (!$used) {
        // 🟢 RESTORE PERTAMA → BALIKIN DATA
        $user->total_xp = $user->backup_xp ?? 0;
        $user->streak_days = $user->backup_streak_days ?? 1;
        $user->level = $user->backup_level ?? 1;
    } else {
        // 🔴 RESTORE KEDUA → RESET TOTAL
        $user->total_xp = 0;
        $user->streak_days = 1;
        $user->level = 1;
    }

    $user->streak_active = true;
    $user->last_xp_date = now();
    $user->character_locked = false;

    // ❗ HAPUS BACKUP
    $user->backup_xp = null;
    $user->backup_streak_days = null;
    $user->backup_level = null;

    $user->save();

    return true;
}

    public function getCurrentCharacter($user)
{
    // 🔥 kalau ke-lock → ambil default
    if ($user->character_locked) {
        return StreakCharacter::where('is_default', true)->first();
    }

    // 🔥 kalau normal → ambil berdasarkan level
    $character = StreakCharacter::where('min_level', '<=', $user->level)
        ->orderByDesc('min_level')
        ->first();

    // 🔥 fallback kalau ga ketemu
    return $character ?? StreakCharacter::where('is_default', true)->first();
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