<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role === $role) {
            return $next($request);
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard.index')->with('error', 'Peserta dilarang masuk ke area admin.');
        }

        if ($user->role === 'peserta') {
            return redirect()->route('beranda')->with('error', 'Anda tidak memiliki akses admin.');
        }

        Auth::logout();
        return redirect()->route('login');
    }
}