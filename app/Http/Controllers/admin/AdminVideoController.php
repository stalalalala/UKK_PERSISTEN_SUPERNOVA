<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos  = AdminVideo::all();              // Video aktif
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
            'iframe'      => 'required', 
        ]);

        AdminVideo::create([
            'subtes'      => $request->subtes,
            'judul_video' => $request->judul_video,
            'iframe'      => $request->iframe, 
        ]);

        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function import(Request $request)
{
    foreach ($request->data as $row) {

        $iframe = trim($row['iframe'] ?? '');

        // decode kalau sudah jadi entity (&lt; &gt;)
        $iframe = html_entity_decode($iframe);

        // hapus tanda kutip luar kalau ada
        $iframe = preg_replace('/^"(.*)"$/', '$1', $iframe);

        AdminVideo::create([
            'subtes' => $row['subtes'] ?? '',
            'judul_video' => $row['judul_video'] ?? '',
            'iframe' => $iframe,
        ]);
    }

    return response()->json(['success' => true]);
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
            'iframe'      => 'required', 
        ]);

        $video->update($request->only(['subtes', 'judul_video', 'iframe'])); 

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
