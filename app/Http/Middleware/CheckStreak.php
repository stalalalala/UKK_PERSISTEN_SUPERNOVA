<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Services\XpService;

class CheckStreak
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $xpService = new XpService();
            $xpService->checkStreakExpired(Auth::user());
        }

        return $next($request);
    }
}
