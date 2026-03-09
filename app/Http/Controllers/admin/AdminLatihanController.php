<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Latihan;
use App\Models\LatihanQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class AdminLatihanController extends Controller
{
    // ============================
    // INDEX
    // ============================
    public function index(Request $request)
    {
        $query = Latihan::withCount('questions');

        // Fitur Filter per Subtes
        if ($request->has('subtes') && $request->subtes != '') {
            $query->where('subtes', $request->subtes);
        }

        $latihans = $query->orderBy('created_at', 'desc')->get();

        $trash = Latihan::onlyTrashed() 
            ->withCount('questions')
            ->latest()
            ->get();

        // Variabel tambahan agar sinkron dengan blade kuis (jika dibutuhkan)
        $allLatihan = Latihan::withCount('questions')->latest()->get();
$historyData = Latihan::onlyTrashed()->withCount('questions')->latest()->get();

$subtesMap = [
    'Penalaran Umum' => 'PU',
    'Pengetahuan & Pemahaman Umum' => 'PPU',
    'Pemahaman Bacaan & Menulis' => 'PBM',
    'Pengetahuan Kuantitatif' => 'PK',
    'Penalaran Matematika' => 'PM',
    'Literasi Bahasa Indonesia' => 'LBI',
    'Literasi Bahasa Inggris' => 'LBE',
];

        return view('admin.latihan.index', compact('latihans', 'trash', 'allLatihan', 'subtesMap', 'historyData'));
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        // Jika karena suatu alasan judul null, berikan nilai fallback agar database tidak error
        $fixJudul = $judul ?? 'Aktivitas Latihan';

        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul, 
            'description' => $deskripsi,
            'status'      => $status,
        ]);
    }

    // edit
    public function edit($id)
{
    $latihans = Latihan::with('questions')->findOrFail($id);

    $questions = $latihans->questions->map(function ($q) {
    return [
        'id' => $q->id,

        'materi' => $q->materi,
        'subtes' => $q->subtes,
        'pertanyaan' => $q->pertanyaan,

        'opsi_a' => $q->opsi_a,
        'opsi_b' => $q->opsi_b,
        'opsi_c' => $q->opsi_c,
        'opsi_d' => $q->opsi_d,
        'opsi_e' => $q->opsi_e,

        'jawaban_benar' => $q->jawaban_benar,
        'pembahasan' => $q->pembahasan,

        'status' => 'original'
    ];
});


    return view('admin.latihan.edit', compact('latihans', 'questions'));
}

// update

public function update(Request $request, $id)
{
    $latihans = Latihan::findOrFail($id);

    $latihans->update([
    'durasi' => $request->durasi ?? $latihans->durasi,
    'materi' => $request->materi ?? $latihans->materi,
    'video_url' => $request->video_url ?? $latihans->video_url,
    'subtes' => $request->subtes ?? $latihans->subtes,
]);


    if ($request->questions_json) {

        $questions = json_decode($request->questions_json, true);

        foreach ($questions as $q) {

            $question = $latihans->questions()->where('id', $q['id'])->first();

            if ($question) {
                $question->update([
    'materi'     => $q['materi'] ?? null,
    'subtes'     => $q['subtes'] ?? null,
    'pertanyaan' => $q['pertanyaan'],

    'opsi_a' => $q['opsi_a'],
    'opsi_b' => $q['opsi_b'],
    'opsi_c' => $q['opsi_c'],
    'opsi_d' => $q['opsi_d'],
    'opsi_e' => $q['opsi_e'],

    'jawaban_benar' => $q['jawaban_benar'],
    'pembahasan' => $q['pembahasan'],
]);

            }
        }
    }

    $this->logAktivitas('UPDATE LATIHAN', $latihans->judul, "Admin memperbarui data latihan");

    return redirect()
        ->route('admin.latihan.index')
        ->with('success', 'Kuis berhasil diperbarui!');
}

    // ============================
    // CREATE FORM
    // ============================
    public function create()
    {
        // Ambil nomor set terakhir secara global
        $lastSet = Latihan::max('set_ke');
        $nextSet = $lastSet ? $lastSet + 1 : 1;

        return view('admin.latihan.create', compact('nextSet'));
    }

    // ============================
    // STORE SET + QUESTIONS (System Kayak Kuis)
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'subtes' => 'required',
            'durasi' => 'required|integer',
            'questions_json' => 'required'
        ]);

        $questions = json_decode($request->questions_json, true);

        if (!$questions || count($questions) < 20) {
            return back()->with('error', 'Harus mengisi minimal 20 soal!');
        }

       // Auto increment set_ke PER SUBTES
$lastSet = Latihan::where('subtes', $request->subtes)
    ->max('set_ke');

$setKe = $lastSet ? $lastSet + 1 : 1;

        // Simpan Header Latihan
        $latihan = Latihan::create([
            'judul'        => "Latihan " . $request->subtes . " Set $setKe",
            'subtes'       => $request->subtes,
            'set_ke'       => $setKe,
            'durasi'       => $request->durasi,
            'is_active'    => true,
            'is_published' => true,
        ]);

        // Simpan Butir Soal
        foreach ($questions as $q) {
            $latihan->questions()->create([
                'materi'        => $q['materi'] ?? null,
                'pertanyaan'    => $q['pertanyaan'],
                'opsi_a'        => $q['opsi_a'],
                'opsi_b'        => $q['opsi_b'],
                'opsi_c'        => $q['opsi_c'],
                'opsi_d'        => $q['opsi_d'],
                'opsi_e'        => $q['opsi_e'],
                'jawaban_benar' => $q['jawaban_benar'],
                'pembahasan'    => $q['pembahasan'] ?? null,
            ]);
            }

        $this->logAktivitas('TAMBAH LATIHAN', $latihan->judul, "Admin menambahkan set latihan baru");
        return redirect()
            ->route('admin.latihan.index')
            ->with('success', 'Set Latihan berhasil dipublish!');
    }

    // ============================
    // DELETE (SOFT DELETE)
    // ============================
    public function destroy($id)
    {
        $latihan = Latihan::findOrFail($id);
        $deletedSetNumber = $latihan->set_ke;
        $judulLatihan = $latihan->judul;

        $latihan->delete();

        SystemLog::where('title', $judulLatihan)->update(['status' => 'deleted']);

        // Opsional: Geser nomor set (ikut sistem kuis)
        Latihan::where('set_ke', '>', $deletedSetNumber)->decrement('set_ke');

        return redirect()
            ->route('admin.latihan.index')
            ->with('success', 'Latihan dipindahkan ke sampah dan urutan diperbarui.');
    }

    // ============================
    // RESTORE FROM TRASH
    // ============================
    public function restore($id)
    {
        $latihan = Latihan::onlyTrashed()->findOrFail($id);
        
        SystemLog::where('title', $latihan->judul)->update(['status' => 'active']);

        $lastSet = Latihan::max('set_ke');
        $newSet = $lastSet ? $lastSet + 1 : 1;

        $latihan->restore();
        $latihan->update([
            'set_ke' => $newSet
        ]);

        return redirect()
            ->route('admin.latihan.index')
            ->with('success', 'Latihan berhasil dipulihkan sebagai Set terakhir.');
    }

    // ============================
    // FORCE DELETE
    // ============================
    public function forceDelete($id)
    {
        $latihan = Latihan::onlyTrashed()->findOrFail($id);

        // Hapus file materi jika ada di storage
        foreach($latihan->questions as $q) {
            if ($q->materi && Storage::disk('public')->exists($q->materi)) {
                Storage::disk('public')->delete($q->materi);
            }
        }

        SystemLog::where('title', $latihan->judul)->delete();

        $latihan->forceDelete();

        return redirect()
            ->route('admin.latihan.index')
            ->with('success', 'Latihan dihapus permanen.');
    }

    // ============================
    // TOGGLE STATUS
    // ============================
    public function toggle($id)
    {
        $latihan = Latihan::findOrFail($id);

        $latihan->update([
            'is_active' => !$latihan->is_active
        ]);

        $status = $latihan->is_active ? 'Mengaktifkan' : 'Menyembunyikan';
        $this->logAktivitas('TOGGLE LATIHAN', $latihan->judul, "Admin $status akses latihan");

        return back()->with('success', 'Status latihan berhasil diubah!');
    }
}