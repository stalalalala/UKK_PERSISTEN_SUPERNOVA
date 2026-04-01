<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        // Jika sudah verifikasi, jangan kasih lihat halaman ini, lempar ke home
        return Auth::user()->hasVerifiedEmail() 
            ? redirect()->intended('/home') 
            : view('Auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        // Menggunakan EmailVerificationRequest bawaan Laravel lebih aman
        $request->fulfill();

        // Redirect ke home dengan pesan sukses
        return redirect('/home')->with('success', 'Email berhasil diverifikasi!');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/home');
        }

        try {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('success', 'Link verifikasi baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi nanti.');
        }
    }
}