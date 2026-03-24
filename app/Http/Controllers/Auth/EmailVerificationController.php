<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        // Pastikan user sudah login sebelum melihat halaman ini
        return view('Auth.verify-email');
    }

    public function verify(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if (! $request->hasValidSignature()) {
            return redirect('/masuk')->with('error', 'Link verifikasi sudah kadaluarsa atau tidak valid.');
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('/masuk')->with('error', 'Token verifikasi tidak cocok.');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect('/masuk')->with('success', 'Email berhasil diverifikasi! Silakan login kembali.');
    }

    // TAMBAHKAN METHOD INI UNTUK MEMPERBAIKI ERROR
    public function resend(Request $request)
    {
        // Jika user sudah verifikasi, langsung arahkan ke home
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        try {
            // Mengirim ulang notifikasi email
            $request->user()->sendEmailVerificationNotification();
            
            return back()->with('success', 'Link verifikasi baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            // Menangkap error jika SMTP Google masih bermasalah/timeout
            return back()->with('error', 'Gagal mengirim email. Silakan cek koneksi internet atau coba lagi nanti.');
        }
    }
}