<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Streak;
use Illuminate\Support\Facades\Auth;

class DailyXpMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'peserta') {
            $user = Auth::user();

            $streak = Streak::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'total_xp' => 0,
                    'jumlah_hari' => 0,
                    'level' => 1,
                    'last_claim' => null,
                    'last_recovery' => null,
                ]
            );

            $today = Carbon::today();

            if ($streak->last_claim) {
                $diff = Carbon::parse($streak->last_claim)->diffInDays($today);

                if ($diff == 1) {
                    // login berturut-turut
                    $streak->jumlah_hari += 1;
                } elseif ($diff >= 5) {
                    // streak mati
                    $streak->jumlah_hari = 0;
                }
                // kalau diff 2–4 hari → tetap lanjut, sesuai aturan kamu
            } else {
                $streak->jumlah_hari = 1;
            }

            // Klaim XP harian
            if (!$streak->last_claim || !Carbon::parse($streak->last_claim)->isSameDay($today)) {
                $streak->total_xp += 50;
                $streak->last_claim = $today;

                // Hitung level (contoh: tiap 200 XP naik level)
                $streak->level = floor($streak->total_xp / 200) + 1;

                $streak->save();
            }
        }

        return $next($request);
    }
}