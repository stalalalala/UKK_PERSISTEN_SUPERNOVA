<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{

// daftar
public function showRegisterForm()
{
    return view('Auth.daftar');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name' => $request->name,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'peserta', // default peserta
    ]);

    return redirect('/masuk')->with('success', 'Berhasil daftar, silakan login.');
}



    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('Auth.masuk');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // CEK ROLE DI SINI
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/'); // Redirect ke beranda peserta
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    

public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    /** @var \Laravel\Socialite\Contracts\User $googleUser */
$googleUser = Socialite::driver('google')->stateless()->user();


    $user = User::where('google_id', $googleUser->id)->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'role' => 'peserta',
            'password' => Hash::make(uniqid()), // password dummy
        ]);
    }

    Auth::login($user);

    return redirect()->intended('/');
}


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/masuk');
    }

    public function store(Request $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Logika Pengalihan
        if ($request->user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/');
    }
}