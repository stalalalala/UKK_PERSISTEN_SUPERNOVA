<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminVideo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos  = AdminVideo::all();              // Video aktif
        $history = AdminVideo::onlyTrashed()->get(); // Video dihapus sementara

        return view('admin.video.index', compact('videos', 'history'));
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas Video';

        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul, 
            'description' => $deskripsi,
            'status'      => $status,
        ]);
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

        $video = AdminVideo::create([
            'subtes'      => $request->subtes,
            'judul_video' => $request->judul_video,
            'iframe'      => $request->iframe, 
        ]);

        $this->logAktivitas('TAMBAH VIDEO', $video->judul_video, "Menambahkan video pembelajaran baru pada subtes {$video->subtes}");
        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }

    public function import(Request $request)
{
    $count = 0;
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
        $count++;
    }

    $this->logAktivitas('IMPORT VIDEO', "Batch Import ($count Video)", "Melakukan import data video pembelajaran");
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

        $this->logAktivitas('UPDATE VIDEO', $video->judul_video, "Memperbarui detail informasi video pembelajaran");

        return redirect()->back()->with('success', 'Video berhasil diperbarui!');
    }

    /**
     * Hapus sementara (soft delete).
     */
    public function destroy($id)
    {
        $video = AdminVideo::findOrFail($id);
        $judul = $video->judul_video;
        $video->delete();

        $this->logAktivitas('HAPUS VIDEO', $judul, "Video dipindahkan ke folder sampah (History)", 'deleted');
        return redirect()->back()->with('success', 'Video dipindahkan ke History.');
    }

    /**
     * Pulihkan video dari history.
     */
    public function restore($id)
    {
        $video = AdminVideo::withTrashed()->findOrFail($id);
        $video->restore();

        $this->logAktivitas('RESTORE VIDEO', $video->judul_video, "Memulihkan video dari history ke daftar video aktif");
        return redirect()->back()->with('success', 'Video berhasil dipulihkan!');
    }

    /**
     * Hapus permanen.
     */
    public function forceDelete($id)
    {
        $video = AdminVideo::withTrashed()->findOrFail($id);
        $judul = $video->judul_video;
        $video->forceDelete();

        $this->logAktivitas('HAPUS PERMANEN VIDEO', $judul, "Menghapus video secara permanen dari database", 'deleted');
        return redirect()->back()->with('success', 'Video dihapus permanen!');
    }
}
