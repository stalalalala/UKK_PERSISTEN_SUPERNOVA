<?php

namespace App\Http\Controllers\admin;

use App\Models\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar tidak merah

class HalamanMonitoringLaporanController extends Controller
{
    /**
     * Menampilkan halaman monitoring dengan data log terbaru.
     */
    public function index()
    {
        $logs = SystemLog::orderBy('created_at', 'desc')->get();
        return view('admin.Monitoring_laporan.index', compact('logs'));
    }


    /**
     * Fungsi untuk mencatat log otomatis.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);

        // Menggunakan Auth::id() lebih stabil di banyak versi editor
        SystemLog::create([
            'id_pengguna' => Auth::id(), 
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'status' => 'active'
        ]);

        return redirect()->back();
    }

    /**
     * Menghapus riwayat log jika diperlukan.
     */
    public function destroy($id)
    {
        $log = SystemLog::findOrFail($id);
        $log->delete();
        return redirect()->back();
    }

    public function updateStatusMultiple(Request $request) {
        SystemLog::whereIn('id', $request->ids)->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }

    public function destroyMultiple(Request $request) {
        SystemLog::whereIn('id', $request->ids)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus permanen');
    }
}