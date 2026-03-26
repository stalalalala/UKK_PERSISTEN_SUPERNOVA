<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminKuisController extends Controller
{
    // ============================
    // INDEX
    // ============================
    public function index()
    {
        $kuis = Kuis::withCount('questions')->orderBy('set_ke', 'desc')->get();
        $trash = Kuis::onlyTrashed()->withCount('questions')->latest()->get();
        $allKuis = Kuis::withCount('questions')->latest()->get();
        $historyData = Kuis::onlyTrashed()->withCount('questions')->latest()->get();

        return view('admin.kuis.index', compact('kuis', 'trash', 'allKuis', 'historyData'));
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas Kuis';

        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul,
            'description' => $deskripsi,
            'status'      => $status,
        ]);
    }

    // ============================
    // CREATE FORM
    // ============================
    public function create()
    {
        $lastSet = Kuis::max('set_ke');
        $nextSet = $lastSet ? $lastSet + 1 : 1;

        return view('admin.kuis.create', compact('nextSet'));
    }

    // ============================
    // STORE QUIZ + QUESTIONS
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'durasi'   => 'required|integer',
            'materi'   => 'nullable',
            'video_url'=> 'nullable',
            'questions_json' => 'required'
        ]);

        $questions = json_decode($request->questions_json, true);

        if (!$questions || count($questions) < 20) {
            return back()->with('error', 'Harus mengisi minimal 20 soal!');
        }

        $lastSet = Kuis::max('set_ke'); 
        $setKe = $lastSet ? $lastSet + 1 : 1;

        $kuis = Kuis::create([
            'judul'     => "Kuis Fundamental Set $setKe",
            'kategori'  => $request->kategori,
            'set_ke'    => $setKe,
            'durasi'    => $request->durasi,
            'materi'    => $request->materi,
            'video_url' => $request->video_url,
            'is_active' => true,
        ]);

        $this->logAktivitas('TAMBAH KUIS', $kuis->judul, "Admin menambahkan kuis baru pada kategori");

        // ====== LOOP SOAL ======
        foreach ($questions as $q) {
            $gambarPath = null;

            // =========================
            // PROSES GAMBAR BASE64
            // =========================
            if (!empty($q['gambar']) && str_starts_with($q['gambar'], 'data:image')) {
                if (preg_match('/^data:image\/(\w+);base64,/', $q['gambar'], $type)) {
                    $extension = strtolower($type[1]);
                    if (!in_array($extension, ['png','jpg','jpeg','webp'])) $extension = 'png';
                    $imageData = substr($q['gambar'], strpos($q['gambar'], ',') + 1);
                    $imageData = base64_decode($imageData);

                    if ($imageData !== false) {
                        $imageName = 'soal_' . uniqid() . '.' . $extension;
                        Storage::disk('public')->put('kuis/' . $imageName, $imageData);
                        $gambarPath = 'kuis/' . $imageName;
                    }
                }
            }
            // =========================
            // PROSES GAMBAR URL
            // =========================
            elseif (!empty($q['gambar']) && filter_var($q['gambar'], FILTER_VALIDATE_URL)) {
                $gambarPath = $q['gambar'];
            }

            // =========================
            // SIMPAN SOAL
            // =========================
            $kuis->questions()->create([
                'materi' => $q['materi'] ?? null,
                'gambar' => $gambarPath,
                'pertanyaan' => $q['pertanyaan'],
                'subtes' => $q['subtes'] ?? null,
                'opsi_a' => $q['opsi_a'],
                'opsi_b' => $q['opsi_b'],
                'opsi_c' => $q['opsi_c'],
                'opsi_d' => $q['opsi_d'],
                'opsi_e' => $q['opsi_e'],
                'jawaban_benar' => $q['jawaban_benar'],
                'bobot' => $q['bobot'] ?? 1,
                'waktu' => $q['waktu'] ?? 30,
            ]);
        }

        return redirect()->route('admin.kuis.index')
            ->with('success', 'Kuis Fundamental berhasil dipublish!');
    }

    // ============================
    // EDIT FORM
    // ============================
    public function edit($id)
    {
        $kuis = Kuis::with('questions')->findOrFail($id);

        // Pastikan tiap soal punya object unik
        $questions = $kuis->questions->map(function ($q) {
    return [
        'id' => $q->id,
        'materi' => $q->materi,
        'gambar' => $q->gambar,
        'subtes' => $q->subtes,
        'waktu' => $q->waktu,
        'pertanyaan' => $q->pertanyaan,
        'opsi_a' => $q->opsi_a,
        'opsi_b' => $q->opsi_b,
        'opsi_c' => $q->opsi_c,
        'opsi_d' => $q->opsi_d,
        'opsi_e' => $q->opsi_e,
        'jawaban_benar' => $q->jawaban_benar,
        'bobot' => $q->bobot,
        'status' => 'original'
    ];
});

        return view('admin.kuis.edit', compact('kuis', 'questions'));
    }

    // ============================
    // UPDATE QUIZ + QUESTIONS
    // ============================
    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        // Update data utama kuis
        $kuis->update([
            'durasi' => $request->durasi ?? $kuis->durasi,
            'materi' => $request->materi ?? $kuis->materi,
            'video_url' => $request->video_url ?? $kuis->video_url,
        ]);

        $this->logAktivitas('UPDATE KUIS', $kuis->judul, "Admin memperbarui data kuis");

        if ($request->questions_json) {
            $questions = json_decode($request->questions_json, true);

            foreach ($questions as $q) {
                // Ambil soal berdasarkan ID
                $question = $kuis->questions()->where('id', $q['id'])->first();
                if (!$question) continue;

                $gambarPath = $question->gambar; // default

                // =========================
                // Jika ada base64 baru
                // =========================
                if (!empty($q['gambar']) && str_starts_with($q['gambar'], 'data:image')) {
                    if (preg_match('/^data:image\/(\w+);base64,/', $q['gambar'], $type)) {
                        $extension = strtolower($type[1]);
                        if (!in_array($extension, ['png','jpg','jpeg','webp'])) $extension = 'png';
                        $imageData = substr($q['gambar'], strpos($q['gambar'], ',') + 1);
                        $imageData = base64_decode($imageData);

                        if ($imageData !== false) {
                            $imageName = 'soal_' . uniqid() . '.' . $extension;
                            Storage::disk('public')->put('kuis/' . $imageName, $imageData);
                            $gambarPath = 'kuis/' . $imageName;
                        }
                    }
                }
                // =========================
                // Jika masih URL, simpan langsung
                // =========================
                elseif (!empty($q['gambar']) && filter_var($q['gambar'], FILTER_VALIDATE_URL)) {
                    $gambarPath = $q['gambar'];
                }

                // =========================
                // UPDATE SOAL
                // =========================
                $question->update([
                    'materi' => $q['materi'] ?? null,
                    'subtes' => $q['subtes'] ?? null,
                    'pertanyaan' => $q['pertanyaan'],
                    'gambar' => $gambarPath,
                    'opsi_a' => $q['opsi_a'],
                    'opsi_b' => $q['opsi_b'],
                    'opsi_c' => $q['opsi_c'],
                    'opsi_d' => $q['opsi_d'],
                    'opsi_e' => $q['opsi_e'],
                    'jawaban_benar' => $q['jawaban_benar'],
                    'bobot' => $q['bobot'] ?? 1,
                    'waktu' => $q['waktu'] ?? 30,
                ]);
            }
        }

        return redirect()->route('admin.kuis.index')
            ->with('success', 'Kuis dan foto soal berhasil diperbarui!');
    }

    // ============================
    // DELETE / RESTORE / FORCE DELETE / TOGGLE
    // ============================
    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);
        $deletedSetNumber = $kuis->set_ke;
        $judulKuis = $kuis->judul;

        $kuis->delete();

        Kuis::where('set_ke', '>', $deletedSetNumber)
            ->decrement('set_ke');

        SystemLog::where('title', $judulKuis)->update(['status' => 'deleted']);

        $kuisToUpdate = Kuis::where('set_ke', '>=', $deletedSetNumber)->get();
        foreach($kuisToUpdate as $k) {
            $k->update(['judul' => "Kuis Fundamental Set " . $k->set_ke]);
        }

        return back()->with('success', 'Kuis dihapus dan urutan set diperbarui!');
    }

    public function restore($id)
    {
        $kuis = Kuis::onlyTrashed()->findOrFail($id);
        $lastSet = Kuis::max('set_ke');
        $newSet = $lastSet ? $lastSet + 1 : 1;

        SystemLog::where('title', $kuis->judul)->update(['status' => 'active']);

        $kuis->restore();
        $kuis->update([
            'set_ke' => $newSet,
            'judul'  => "Kuis Fundamental Set $newSet"
        ]);

        return back()->with('success', 'Kuis dipulihkan sebagai Set terakhir!');
    }

    public function toggle($id)
    {
        $kuis = Kuis::findOrFail($id);
        $kuis->update(['is_active' => !$kuis->is_active]);

        return back()->with('success', 'Status kuis berhasil diubah!');
    }

    public function show($id)
    {
        $kuis = Kuis::with('questions')->findOrFail($id);
        return view('admin.kuis.show', compact('kuis'));
    }

    public function forceDelete($id)
    {
        $kuis = Kuis::onlyTrashed()->findOrFail($id);
        $judulKuis = $kuis->judul;

        SystemLog::where('title', $judulKuis)->delete();
        $kuis->forceDelete();

        return back()->with('success', 'Kuis berhasil dihapus permanen!');
    }
}