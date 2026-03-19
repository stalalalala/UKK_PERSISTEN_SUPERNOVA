<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
   public function notice()
    {
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
}

   

