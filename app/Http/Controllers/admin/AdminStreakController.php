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
        $streaks = StreakCharacter::orderBy('min_level', 'asc')->get();
    $trash = StreakCharacter::onlyTrashed()->orderBy('min_level')->get();

    return view('admin.streak.index', compact('streaks','trash'));
    }

    /**
     * FORM TAMBAH KARAKTER
     */
    public function create()
    {
        $animations = [
            'bounce',
            'float',
            'wiggle',
            'spin',
            'pulse'
        ];

        return view('admin.streak.create', compact('animations'));
    }

    /**
     * SIMPAN KARAKTER BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'svg' => 'required|mimes:svg|max:2048',
            'min_level' => 'required|integer|min:1',
            'animation' => 'required|in:bounce,float,wiggle,spin,pulse'
        ]);

        $svgPath = null;

        if ($request->hasFile('svg')) {
            $svgPath = $request->file('svg')->store('streak', 'public');
        }

        StreakCharacter::create([
            'nama' => $request->nama,
            'svg_path' => $svgPath,
            'min_level' => $request->min_level,
            'animation' => $request->animation
        ]);

        return redirect()
            ->route('admin.streak.index')
            ->with('success', 'Karakter streak berhasil ditambahkan');
    }

    /**
     * FORM EDIT KARAKTER
     */
    public function edit($id)
    {
        $character = StreakCharacter::findOrFail($id);

        $animations = [
            'bounce',
            'float',
            'wiggle',
            'spin',
            'pulse'
        ];

        return view('admin.streak.edit', compact('character', 'animations'));
    }

    /**
     * UPDATE KARAKTER
     */
    public function update(Request $request, $id)
    {
        $character = StreakCharacter::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'svg' => 'nullable|mimes:svg|max:2048',
            'min_level' => 'required|integer|min:1',
            'animation' => 'required|in:bounce,float,wiggle,spin,pulse'
        ]);

        $svgPath = $character->svg_path;

        if ($request->hasFile('svg')) {

            if ($character->svg_path && Storage::disk('public')->exists($character->svg_path)) {
                Storage::disk('public')->delete($character->svg_path);
            }

            $svgPath = $request->file('svg')->store('streak', 'public');
        }

        $character->update([
            'nama' => $request->nama,
            'svg_path' => $svgPath,
            'min_level' => $request->min_level,
            'animation' => $request->animation
        ]);

        return redirect()
            ->route('admin.streak.index')
            ->with('success', 'Karakter streak berhasil diperbarui');
    }

    /**
     * HAPUS KARAKTER
     */
    public function destroy($id)
    {
        $character = StreakCharacter::findOrFail($id);

        if ($character->svg_path && Storage::disk('public')->exists($character->svg_path)) {
            Storage::disk('public')->delete($character->svg_path);
        }

        $character->delete();

        return redirect()
            ->route('admin.streak.index')
            ->with('success', 'Karakter streak berhasil dihapus');
    }
}