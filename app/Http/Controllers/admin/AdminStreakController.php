<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StreakCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminStreakController extends Controller
{
    /**
     * LIST SEMUA KARAKTER
     */
    public function index()
    {
        // Mengambil data dari yang terbaru ke terlama
$streaks = StreakCharacter::orderBy('created_at', 'desc')->get();

// Mengambil data trash dari yang dihapus paling terakhir
$trash = StreakCharacter::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

    return view('admin.streak.index', compact('streaks','trash'));
    }

    /**
     * FORM TAMBAH KARAKTER
     */
    public function create()
    {
        // $animations = [
        //     'bounce',
        //     'float',
        //     'wiggle',
        //     'spin',
        //     'pulse'
        // ];

        // return view('admin.streak.create', compact('animations'));
        return view('admin.streak.create');
    }

    /**
     * SIMPAN KARAKTER BARU
     */
public function store(Request $request)
{
    $request->validate([
    'nama' => 'required|string|max:100',
    'min_level' => 'required|integer|min:1',
    'svg_static' => 'nullable|file|mimes:svg,xml|max:2048',
    'svg_animated' => 'nullable|file|mimes:svg,xml|max:2048',
]);

    $svgStaticPath = null;
$svgAnimatedPath = null;

// TANPA ANIMASI
if ($request->hasFile('svg_static')) {
    $svgStaticPath = $request->file('svg_static')->store('streak', 'public');
}

// DENGAN ANIMASI
if ($request->hasFile('svg_animated')) {
    $svgAnimatedPath = $request->file('svg_animated')->store('streak-animasi', 'public');
}

 

    StreakCharacter::create([
    'nama' => $request->nama,
    'svg_path' => $svgStaticPath,
    'svg_animated_path' => $svgAnimatedPath,
    'min_level' => $request->min_level,
]);

    return redirect()->route('admin.streak.index')->with('success', 'Berhasil disimpan!');
}

    /**
     * FORM EDIT KARAKTER
     */
    public function edit($id)
{
    $character = StreakCharacter::findOrFail($id);

    if ($character->is_default) {
        return redirect()->route('admin.streak.index')
            ->with('error', 'Karakter default tidak bisa diedit.');
    }

    return view('admin.streak.edit', compact('character'));
}

public function update(Request $request, $id)
{
    $character = StreakCharacter::findOrFail($id);

    if ($character->is_default) {
        return redirect()->route('admin.streak.index')
            ->with('error', 'Karakter default tidak bisa diedit.');
    }

    $request->validate([
        'nama' => 'required|string|max:100',
        'min_level' => 'required|integer|min:1',
        'svg_static' => 'sometimes|file|mimes:svg,xml|max:2048',
'svg_animated' => 'sometimes|file|mimes:svg,xml|max:2048',
    ]);

    // =====================
    // SVG STATIC
    // =====================
    if ($request->hasFile('svg_static')) {

        if ($character->svg_path) {
            Storage::disk('public')->delete($character->svg_path);
        }

        $character->svg_path = $request->file('svg_static')->store('streak', 'public');
    }

    // =====================
    // SVG ANIMASI
    // =====================
    if ($request->hasFile('svg_animated')) {

        if ($character->svg_animated_path) {
            Storage::disk('public')->delete($character->svg_animated_path);
        }

        $character->svg_animated_path = $request->file('svg_animated')->store('streak-animasi', 'public');
    }

    // =====================
    // UPDATE DATA
    // =====================
    $character->nama = $request->nama;
    $character->min_level = $request->min_level;

    $character->save(); // 🔥 penting

    return redirect()->route('admin.streak.index')
        ->with('success', 'Karakter streak berhasil diperbarui');
}

    /**
     * HAPUS KARAKTER
     */
   public function destroy($id)
{
    $character = StreakCharacter::findOrFail($id);

    if ($character->is_default) {
        return redirect()->route('admin.streak.index')
            ->with('error', 'Karakter default tidak bisa dihapus.');
    }

    $character->delete();

    return redirect()->route('admin.streak.index')
        ->with('success', 'Karakter streak berhasil dipindahkan ke history');
}

public function restore($id)
{
    $streak = StreakCharacter::onlyTrashed()->findOrFail($id);
    $streak->restore();

    return redirect()->route('admin.streak.index')->with('success', 'Pet berhasil dipulihkan!');
}

public function forceDelete($id)
    {
        // Ambil data yang sudah di soft delete
        $streak = StreakCharacter::onlyTrashed()->findOrFail($id);

        // Hapus permanen
        $streak->forceDelete();

        return redirect()->back()->with('success', 'Pet berhasil dihapus permanen!');
    }
}