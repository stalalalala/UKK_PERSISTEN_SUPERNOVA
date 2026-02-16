<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    /**
     * Tampilkan daftar video + history.
     */
    public function index()
    {
        $videos  = AdminVideo::all();          // Video aktif
        $history = AdminVideo::onlyTrashed()->get(); // Video dihapus sementara

        return view('admin.video.index', compact('videos', 'history'));
    }

    /**
     * Simpan video baru.
     */
    public function store(Request $request)
{
    $request->validate([
        'subtes'      => 'required',
        'judul_video' => 'required',
        'link'        => 'required|url',
    ]);

    AdminVideo::create([
        'subtes'      => $request->subtes,
        'judul_video' => $request->judul_video,
        'link'        => $request->link,
    ]);

    return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
}


    /**
     * Update video.
     */
    public function update(Request $request, $id)
    {
        $video = AdminVideo::findOrFail($id);

        $request->validate([
            'subtes'      => 'required',
            'judul_video' => 'required',
            'link'        => 'required|url',
        ]);

        $video->update($request->only(['subtes', 'judul_video', 'link']));

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Hapus sementara (soft delete).
     */
    public function destroy($id)
    {
        $video = AdminVideo::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('success', 'Video dipindahkan ke History.');
    }

    /**
     * Pulihkan video dari history.
     */
    public function restore($id)
    {
        $video = AdminVideo::withTrashed()->findOrFail($id);
        $video->restore();

        return redirect()->back()->with('success', 'Video berhasil dipulihkan!');
    }

    /**
     * Hapus permanen.
     */
    public function forceDelete($id)
    {
        $video = AdminVideo::withTrashed()->findOrFail($id);
        $video->forceDelete();

        return redirect()->back()->with('success', 'Video dihapus permanen!');
    }
}
