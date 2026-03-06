<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slime;
use Illuminate\Http\Request;

class AdminStreakController extends Controller
{

    public function index()
{
    $slimes = Slime::latest()->get();
    $activeSlimes = Slime::where('is_active',1)->get();
    $inactiveSlimes = Slime::where('is_active',0)->get();

    return view('admin.streak.index', compact(
        'slimes',
        'activeSlimes',
        'inactiveSlimes'
    ));
}


    public function create()
    {
        return view('admin.streak.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'level_min' => 'required|integer',
            'animasi' => 'required'
        ]);

        Slime::create([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'level_min' => $request->level_min,
            'animasi' => $request->animasi,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->route('admin.streak.index')
            ->with('success','Slime berhasil dibuat');
    }


    public function edit($id)
    {
        $slime = Slime::findOrFail($id);
        return view('admin.streak.edit', compact('slime'));
    }


    public function update(Request $request, $id)
    {
        $slime = Slime::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'level_min' => 'required|integer',
            'animasi' => 'required'
        ]);

        $slime->update([
            'nama' => $request->nama,
            'gambar' => $request->gambar,
            'level_min' => $request->level_min,
            'animasi' => $request->animasi,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->route('admin.streak.index')
            ->with('success','Slime berhasil diupdate');
    }


    public function destroy($id)
    {
        Slime::destroy($id);

        return back()->with('success','Slime berhasil dihapus');
    }

}