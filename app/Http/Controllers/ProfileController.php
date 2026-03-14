<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $user = Auth::user();
       return view('profile.index', compact('user'));
    }

    
    public function edit()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'no_hp'    => 'required|numeric|digits_between:11,100', 
        'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'password' => [
            'nullable',
            'min:6', 
            'confirmed',
            'regex:/[0-9]/',      
            'regex:/[@$!%*#?&]/', 
        ],
    ], [
        'password.regex' => 'Password baru harus mengandung minimal satu angka dan satu simbol.',
        'no_hp.digits_between' => 'Nomor HP minimal harus 11 karakter.',
    ]);

    $user->name = $request->name;
    $user->no_hp = $request->no_hp;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('photo')) {
        if ($user->photo && file_exists(public_path('storage/'.$user->photo))) {
            unlink(public_path('storage/'.$user->photo));
        }
        $path = $request->file('photo')->store('profile', 'public');
        $user->photo = $path;
    }

    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui');
}
}
