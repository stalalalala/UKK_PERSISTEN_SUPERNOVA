<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        // Ambil data yang aktif
    $videos = AdminVideo::all();

    // Ambil data yang ada di history (soft deleted)
    $history = AdminVideo::onlyTrashed()->get();

    // Kirim keduanya ke view
    return view('admin.video.index', compact('videos', 'history'));
    }

    /**
     * Simpan video baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video_id'    => 'required|unique:admin_videos,video_id',
            'subtes'      => 'required',
            'judul_video' => 'required',
            'link'        => 'required|url',
        ]);

        AdminVideo::create($request->all());

        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }

    /**
     * Update data video yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $video = AdminVideo::findOrFail($id);

        $request->validate([
            'subtes'      => 'required',
            'judul_video' => 'required',
            'link'        => 'required|url',
        ]);

        $video->update($request->all());

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Hapus sementara (Pindahkan ke History).
     */
    public function destroy($id)
    {
        $video = AdminVideo::findOrFail($id);
        $video->delete(); // Mengisi kolom deleted_at

        return redirect()->back()->with('success', 'Video dipindahkan ke History.');
    }

    /**
     * Tampilkan halaman History (Data yang dihapus sementara).
     */
    public function history()
    {
        $history = AdminVideo::onlyTrashed()->get();
        return view('admin.video.history', compact('history'));
    }

    /**
     * Pulihkan video dari History.
     */
    public function restore($id)
    {
        $video = AdminVideo::withTrashed()->where('video_id', $id)->firstOrFail();
        $video->restore();

        return redirect()->back()->with('success', 'Video berhasil dipulihkan!');
    }

    /**
     * Hapus permanen dari database.
     */
    public function forceDelete($id)
    {
        $video = AdminVideo::withTrashed()->where('video_id', $id)->firstOrFail();
        $video->forceDelete();

        return redirect()->back()->with('success', 'Video dihapus permanen!');
    }
}
