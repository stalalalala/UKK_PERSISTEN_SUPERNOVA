<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Latihan;
use App\Models\LatihanQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminLatihanController extends Controller
{
    /**
     * Menampilkan daftar latihan dengan fitur filter subtes
     */
    public function index(Request $request)
    {
        $query = Latihan::withCount('questions');

        // Fitur Filter per Subtes atau Kategori
        if ($request->has('subtes') && $request->subtes != '') {
            $query->where('subtes', $request->subtes);
        }

        // Urutkan berdasarkan yang terbaru (tergantung jam pembuatan sesuai request kamu)
        $latihans = $query->orderBy('created_at', 'desc')->get();

        // Data untuk tab History (Data yang di-soft delete)
        $history = Latihan::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        $allLatihan = Latihan::withCount('questions')->latest()->get();
$historyData = Latihan::onlyTrashed()->withCount('questions')->latest()->get();

        return view('admin.latihan.index', compact('latihans', 'history', 'allLatihan', 'historyData'));
    }

    /**
     * Proses simpan Set Latihan baru (Header)
     */
    public function store(Request $request)
    {
        $request->validate([
            'subtes' => 'required',
            'set_ke' => 'required',
            'durasi' => 'required|numeric',
        ]);

        Latihan::create([
            'subtes' => $request->subtes,
            'set_ke' => $request->set_ke,
            'durasi' => $request->durasi,
            'is_active' => false,
            'is_published' => false, // Default false sebelum 20 soal
        ]);

        return redirect()->back()->with('success', 'Set Latihan berhasil dibuat. Silakan isi soal.');
    }

    /**
     * Proses simpan butir soal (Pertanyaan, Materi, Pembahasan)
     */
    public function storeQuestion(Request $request, $latihan_id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban_benar' => 'required|max:1',
            'pembahasan' => 'required',
            'materi_file' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $materi = $request->materi_teks;

        // Jika ada input foto materi, simpan fotonya
        if ($request->hasFile('materi_file')) {
            $path = $request->file('materi_file')->store('materi_latihan', 'public');
            $materi = $path;
        }

        LatihanQuestion::create([
            'latihan_id' => $latihan_id,
            'materi' => $materi,
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan' => $request->pembahasan,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Toggle Publish (Syarat Wajib 20 Soal)
     */
    public function togglePublish($id)
    {
        $latihan = Latihan::findOrFail($id);

        // Cek apakah soal sudah 20
        if (!$latihan->isComplete() && !$latihan->is_published) {
            return redirect()->back()->with('error', 'Minimal harus ada 20 soal sebelum dipublikasikan!');
        }

        $latihan->update([
            'is_published' => !$latihan->is_published,
            'is_active' => !$latihan->is_published ? true : $latihan->is_active
        ]);

        return redirect()->back()->with('success', 'Status publikasi berhasil diubah.');
    }

    /**
     * Edit Soal
     */
    public function updateQuestion(Request $request, $id)
    {
        $question = LatihanQuestion::findOrFail($id);
        
        // Logika edit materi (Ganti foto atau update teks)
        $materi = $request->materi_teks;
        if ($request->hasFile('materi_file')) {
            if ($question->materi && Storage::disk('public')->exists($question->materi)) {
                Storage::disk('public')->delete($question->materi);
            }
            $materi = $request->file('materi_file')->store('materi_latihan', 'public');
        }

        $question->update([
            'materi' => $materi,
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'opsi_e' => $request->opsi_e,
            'jawaban_benar' => $request->jawaban_benar,
            'pembahasan' => $request->pembahasan,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Soft Delete (Masuk ke History)
     */
    public function destroy($id)
    {
        Latihan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Set Latihan dipindahkan ke sampah.');
    }

    /**
     * Restore dari History
     */
    public function restore($id)
    {
        Latihan::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success', 'Set Latihan berhasil dipulihkan.');
    }

    /**
     * Hapus Permanen
     */
    public function forceDelete($id)
    {
        $latihan = Latihan::onlyTrashed()->findOrFail($id);
        // Hapus juga file-file materi soalnya jika ada
        foreach($latihan->questions as $q) {
            if ($q->materi && Storage::disk('public')->exists($q->materi)) {
                Storage::disk('public')->delete($q->materi);
            }
        }
        $latihan->forceDelete();
        return redirect()->back()->with('success', 'Data dihapus permanen.');
    }
}