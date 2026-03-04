<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{    // ==============================
    // REGISTER MANUAL
    // ==============================
    public function showRegisterForm()
    {
        return view('Auth.daftar');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'no_hp'    => 'required|string|max:20',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
        'name' => $request->name,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'peserta',
]);

$user->sendEmailVerificationNotification();

return redirect()->route('verification.notice')
    ->with('success', 'Silakan verifikasi email terlebih dahulu.');
    }

    // ==============================
    // LOGIN MANUAL
    // ==============================
    public function showLoginForm()
    {
        return view('Auth.masuk');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // ✅ Kalau admin → langsung masuk dashboard tanpa verifikasi
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            // ✅ Kalau bukan admin dan belum verifikasi
           if ($user->role === 'peserta' && !$user->hasVerifiedEmail()) {
    return redirect()->route('verification.notice')
        ->with('warning', 'Silakan verifikasi email terlebih dahulu.');
}

            // Default peserta
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ==============================
    // GOOGLE LOGIN / DAFTAR
    // ==============================
   public function redirectToGoogle()
{
    return Socialite::driver('google')->stateless()->with(['prompt' => 'select_account'])->redirect();
}

   public function handleGoogleCallback()
{
    try {
       $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->email)->first();

        // Jika belum ada → buat user baru
        if (!$user) {
            $user = User::create([
                'name'              => $googleUser->name,
                'email'             => $googleUser->email,
                'google_id'         => $googleUser->id,
                'role'              => 'peserta',
                'password'          => Hash::make(uniqid()),
                'email_verified_at' => now(), // 🔥 penting
            ]);
        } else {
            // Kalau user sudah ada tapi belum verified
            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
                $user->save();
            }
        }

        Auth::login($user);
        session()->regenerate();

        return redirect('/'); // jangan pakai intended dulu

    } catch (\Exception $e) {
        dd($e->getMessage()); // kalau masih error kita bisa lihat penyebabnya
    }
}

    // ==============================
    // LOGOUT
    // ==============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/masuk');
    }
}