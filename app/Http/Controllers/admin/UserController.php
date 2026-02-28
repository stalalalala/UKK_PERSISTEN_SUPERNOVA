<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | INDEX (Tampilkan Admin, Peserta, History)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return view('admin.user.index', [
            'admins'   => User::where('role', 'admin')->get(),
            'pesertas' => User::where('role', 'peserta')->get(),
            'history'  => User::onlyTrashed()->get()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (Tambah Admin)
    |--------------------------------------------------------------------------
    */
   public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'no_hp' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('admin_photos', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'no_hp' => $request->no_hp,
            'photo' => $photoPath
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan');
    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan, coba lagi.');
    }
}


    /*
    |--------------------------------------------------------------------------
    | UPDATE (Edit Admin)
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, User $user)
    {
       
        if ($user->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6|confirmed',
            'no_hp'     => 'nullable|string|max:20',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto baru
        if ($request->hasFile('photo')) {

            // Hapus foto lama kalau ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $user->photo = $request->file('photo')
                ->store('admin_photos', 'public');
        }

        // Update password kalau diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        $user->save();

        return back()->with('success', 'Admin berhasil diupdate');
    }

    /*
    |--------------------------------------------------------------------------
    | SOFT DELETE (Masuk History)
    |--------------------------------------------------------------------------
    */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User dipindahkan ke history');
    }

    /*
    |--------------------------------------------------------------------------
    | RESTORE (Pulihkan dari History)
    |--------------------------------------------------------------------------
    */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('success', 'User berhasil dipulihkan');
    }

    /*
    |--------------------------------------------------------------------------
    | FORCE DELETE (Hapus Permanen)
    |--------------------------------------------------------------------------
    */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        // Hapus foto jika ada
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->forceDelete();

        return back()->with('success', 'User dihapus permanen');
    }
}
