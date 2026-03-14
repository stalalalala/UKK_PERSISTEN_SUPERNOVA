<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordForgotController extends Controller
{
    public function showForm()
    {
        return view('auth.lupa-password');
    }

   public function sendLink(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ], [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return back()->with('status', 'Link reset password sudah dikirim ke email Anda!');
    }

    return back()->withErrors(['email' => 'Alamat email tidak terdaftar di sistem kami.']);
}
}