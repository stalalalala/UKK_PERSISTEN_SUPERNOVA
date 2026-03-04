<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Streak;
use Carbon\Carbon;

class DailyXpMiddleware
{
    public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {

        $user = Auth::user();

        $streak = Streak::firstOrCreate(
            ['user_id' => $user->id],
            [
                'total_xp' => 0,
                'jumlah_hari' => 0,
                'level' => 1,
                'recovery_used' => 0,
                'recovery_month' => now()->format('Y-m')
            ]
        );

        $today = now()->toDateString();
        $currentMonth = now()->format('Y-m');

        // Reset recovery tiap bulan
        if ($streak->recovery_month !== $currentMonth) {
            $streak->recovery_used = 0;
            $streak->recovery_month = $currentMonth;
        }

        $lastDate = $streak->last_active_at
            ? \Carbon\Carbon::parse($streak->last_active_at)->toDateString()
            : null;

        // Kalau belum login hari ini
        if ($lastDate !== $today) {

            if ($lastDate) {

                $diff = \Carbon\Carbon::parse($streak->last_active_at)
                    ->diffInDays($today);

                if ($diff >= 5) {

                    if ($streak->recovery_used < 1) {
                        $streak->recovery_used = 1;
                    } else {
                        $streak->total_xp = 0;
                        $streak->jumlah_hari = 0;
                        $streak->level = 1;
                    }
                }
            }

            
            if ($lastDate !== $today) {

            // Tambah XP harian
            $streak->jumlah_hari += 1;
            $streak->total_xp += 50;
            $streak->last_active_at = now();

            // =========================
            // LEVEL UP & PET OTOMATIS
            // =========================

            // Contoh level ranges
            // $levelRanges = [
            //     1 => ['maxXp' => 300, 'pet' => 'pet_level1'],
            //     6 => ['maxXp' => 600, 'pet' => 'pet_level2'],
            //     11 => ['maxXp' => 1000, 'pet' => 'pet_level3'], // dst
            // ];

            // Tentukan level & pet awal
            // foreach ($levelRanges as $startLevel => $data) {
            //     if ($streak->level >= $startLevel) {
            //         $maxXpCurrent = $data['maxXp'];
            //         $petCurrent = $data['pet'];
            //     }
            // }

            // Naik level jika total_xp melebihi maxXp
            // while ($streak->total_xp >= $maxXpCurrent) {
            //     $streak->total_xp -= $maxXpCurrent;
            //     $streak->level += 1;

            //     // update maxXp & pet sesuai level baru
            //     foreach ($levelRanges as $startLevel => $data) {
            //         if ($streak->level >= $startLevel) {
            //             $maxXpCurrent = $data['maxXp'];
            //             $petCurrent = $data['pet'];
            //         }
            //     }
            // }

            // Simpan pet sesuai level
            // $streak->pet = $petCurrent;

            // Simpan semua perubahan
            $streak->save();
        }
                }
            }

            return $next($request);
        }
}