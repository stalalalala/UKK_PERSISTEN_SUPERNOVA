<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
      // Halaman notifikasi verifikasi
   public function notice()
    {
        return view('Auth.verify-email');
    }

    // UPDATE FUNGSI INI
    public function verify(Request $request)
    {
        // Cari user berdasarkan ID di link email
        $user = User::findOrFail($request->route('id'));

        // Cek validasi link (hash)
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('/masuk')->with('error', 'Link verifikasi tidak valid.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Arahkan ke halaman masuk dengan pesan sukses
        return redirect('/masuk')->with('success', 'Email berhasil diverifikasi! Silakan login kembali di perangkat Anda.');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Link verifikasi baru telah dikirim.');
    }
}

   

