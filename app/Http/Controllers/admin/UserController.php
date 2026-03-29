<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

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
            'admins'   => User::where('role', 'admin')
                            ->orderBy('updated_at', 'desc') 
                            ->get(),
            'pesertas' => User::where('role', 'peserta')->latest()->get(),
            'history'  => User::onlyTrashed()->latest()->get()
        ]);
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas User';

        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul, 
            'description' => $deskripsi,
            'status'      => $status,
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
            'email' => 'required|email',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/[0-9]/',      
                'regex:/[^A-Za-z0-9]/',
            ],
            'no_hp' => 'nullable|digits_between:11,100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('admin_photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'no_hp' => $request->no_hp,
            'photo' => $photoPath
        ]);

        $this->logAktivitas('TAMBAH ADMIN', $user->name, "Admin baru berhasil didaftarkan ke sistem");

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
    try {

        if ($user->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => [
                'nullable', 
                'min:6',
                'regex:/^(?=.*[0-9])(?=.*[\W]).+$/',
                'confirmed'
            ],
            'no_hp' => 'nullable|digits_between:11,100',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Upload foto baru
        if ($request->hasFile('photo')) {

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

        $this->logAktivitas('UPDATE ADMIN', $user->name, "Melakukan pembaruan data profil admin");

        return back()->with('success', 'Admin berhasil diupdate');

    } catch (\Exception $e) {

        return back()->with('error', 'Gagal memperbarui data admin');
    }
}

    /*
    |--------------------------------------------------------------------------
    | SOFT DELETE (Masuk History)
    |--------------------------------------------------------------------------
    */
    public function destroy(User $user)
    {
        $nama = $user->name;
        $role = strtoupper($user->role);
        $user->delete();

        
        $this->logAktivitas("HAPUS $role", $nama, "User dipindahkan ke riwayat/history", 'deleted');

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

        $this->logAktivitas('RESTORE USER', $user->name, "Memulihkan user " . strtoupper($user->role) . " dari history");

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
        $nama = $user->name;

        // Hapus foto jika ada
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->forceDelete();

        $this->logAktivitas('HAPUS PERMANEN', $nama, "Menghapus data user secara permanen dari database", 'deleted');

        return back()->with('success', 'User dihapus permanen');
    }
}
