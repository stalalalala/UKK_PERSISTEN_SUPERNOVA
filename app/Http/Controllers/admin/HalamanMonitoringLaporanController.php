<?php

namespace App\Http\Controllers\admin;

use App\Models\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function downloadPDF(Request $request)
    {
        $year = $request->query('year');
        $monthName = $request->query('month');
        $week = $request->query('week');

        // Mapping nama bulan Indonesia ke angka
        $months = [
            'Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4,
            'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8,
            'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12
        ];

        $monthNumber = $months[$monthName] ?? 1;

        // Ambil data log sesuai kriteria
        $logs = SystemLog::with('user')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $monthNumber)
            ->where('status', 'active')
            ->get()
            ->filter(function($log) use ($week) {
                return ceil($log->created_at->day / 7) == $week;
            });

        $title = "Laporan Aktivitas - Minggu $week $monthName $year";

        // Load view khusus untuk PDF
        $pdf = Pdf::loadView('admin.Monitoring_laporan.pdf', compact('logs', 'title', 'year', 'monthName', 'week'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download("Laporan_Persisten_{$year}_{$monthName}_Minggu_{$week}.pdf");
    }
}