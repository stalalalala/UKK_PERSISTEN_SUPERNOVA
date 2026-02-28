<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
      // Halaman notifikasi verifikasi
    public function notice()
    {
        return view('Auth.verify-email');
    }

    // Proses klik link verifikasi
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/masuk')->with('success', 'Email berhasil diverifikasi. Silakan login.');
    }

    // Kirim ulang email verifikasi
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/')->with('info', 'Email sudah diverifikasi.');
        }

        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link verifikasi baru telah dikirim ke email Anda.');
    }
}
