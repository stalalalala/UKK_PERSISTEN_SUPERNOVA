<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;

class AdminKuisController extends Controller
{
    // ============================
    // INDEX
    // ============================
    public function index()
    {
        $kuis = Kuis::withCount('questions')
        ->orderBy('set_ke', 'desc')
        ->get();

        $trash = Kuis::onlyTrashed() 
            ->withCount('questions')
            ->latest()
            ->get();


        $allKuis = Kuis::withCount('questions')->latest()->get();
$historyData = Kuis::onlyTrashed()->withCount('questions')->latest()->get();

return view('admin.kuis.index', compact('kuis', 'trash', 'allKuis', 'historyData'));

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
    // STORE QUIZ + 20 QUESTIONS
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

        // decode soal dari hidden input
        $questions = json_decode($request->questions_json, true);

        if (!$questions || count($questions) < 20) {
            return back()->with('error', 'Harus mengisi minimal 20 soal!');
        }

        // ============================
        // AUTO SET NUMBER
        // ============================
        $lastSet = Kuis::max('set_ke'); 
    $setKe = $lastSet ? $lastSet + 1 : 1;

        // ============================
        // CREATE QUIZ SET
        // ============================
        $kuis = Kuis::create([
            'judul'     => "Kuis Fundamental Set $setKe",
            'kategori'  => $request->kategori,
            'set_ke'    => $setKe,
            'durasi'    => $request->durasi,
            'materi'    => $request->materi,
            'video_url' => $request->video_url,
            'is_active' => true,
        ]);

        // ============================
        // SAVE QUESTIONS
        // ============================
        foreach ($questions as $q) {
    $kuis->questions()->create([
        'materi'     => $q['materi'] ?? null,
        'pertanyaan' => $q['pertanyaan'],
        'subtes'     => $q['subtes'] ?? null,

        'opsi_a' => $q['opsi_a'],
        'opsi_b' => $q['opsi_b'],
        'opsi_c' => $q['opsi_c'],
        'opsi_d' => $q['opsi_d'],
        'opsi_e' => $q['opsi_e'],

        'jawaban_benar' => $q['jawaban_benar'],
        'bobot' => $q['bobot'] ?? 1,
    ]);
}


        return redirect()
            ->route('admin.kuis.index')
            ->with('success', 'Kuis Fundamental berhasil dipublish!');
    }

    // ============================
    // EDIT FORM
    // ============================
    public function edit($id)
{
    $kuis = Kuis::with('questions')->findOrFail($id);

    $questions = $kuis->questions->map(function ($q) {
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
        'bobot' => $q->bobot,

        'status' => 'original'
    ];
});


    return view('admin.kuis.edit', compact('kuis', 'questions'));
}




    // ============================
    // UPDATE QUIZ + QUESTIONS OPTIONAL
    // ============================
    public function update(Request $request, $id)
{
    $kuis = Kuis::findOrFail($id);

    $kuis->update([
    'durasi' => $request->durasi ?? $kuis->durasi,
    'materi' => $request->materi ?? $kuis->materi,
    'video_url' => $request->video_url ?? $kuis->video_url,
]);


    if ($request->questions_json) {

        $questions = json_decode($request->questions_json, true);

        foreach ($questions as $q) {

            $question = $kuis->questions()->where('id', $q['id'])->first();

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
    'bobot' => $q['bobot'] ?? 1,
]);

            }
        }
    }

    return redirect()
        ->route('admin.kuis.index')
        ->with('success', 'Kuis berhasil diperbarui!');
}



    // ============================
    // DELETE (SOFT DELETE)
    // ============================
    public function destroy($id)
{
    $kuis = Kuis::findOrFail($id);
    $deletedSetNumber = $kuis->set_ke;

    // 1. Hapus kuis (Soft Delete)
    $kuis->delete();

    // 2. Geser nomor set yang lain ke bawah (decrement)
    // Semua kuis yang set_ke-nya di atas nomor yang dihapus akan dikurangi 1
    Kuis::where('set_ke', '>', $deletedSetNumber)
        ->decrement('set_ke');
    
    // 3. Update Judul agar sesuai dengan nomor set yang baru
    // Karena judulmu mengandung kata "Set X", maka judulnya perlu di-refresh
    $kuisToUpdate = Kuis::where('set_ke', '>=', $deletedSetNumber)->get();
    foreach($kuisToUpdate as $k) {
        $k->update([
            'judul' => "Kuis Fundamental Set " . $k->set_ke
        ]);
    }

    return back()->with('success', 'Kuis dihapus dan urutan set diperbarui!');
}

    // ============================
    // RESTORE FROM TRASH
    // ============================
    public function restore($id)
{
    $kuis = Kuis::onlyTrashed()->findOrFail($id);
    
    // Cari angka set tertinggi saat ini di tabel aktif
    $lastSet = Kuis::max('set_ke');
    $newSet = $lastSet ? $lastSet + 1 : 1;

    // Pulihkan dengan nomor set baru di urutan paling akhir
    $kuis->restore();
    $kuis->update([
        'set_ke' => $newSet,
        'judul'  => "Kuis Fundamental Set $newSet"
    ]);

    return back()->with('success', 'Kuis dipulihkan sebagai Set terakhir!');
}

    // ============================
    // TOGGLE ACTIVE / HIDDEN
    // ============================
    public function toggle($id)
    {
        $kuis = Kuis::findOrFail($id);

        $kuis->update([
            'is_active' => !$kuis->is_active
        ]);

        return back()->with('success', 'Status kuis berhasil diubah!');
    }

    // ============================
// SHOW / PREVIEW
// ============================
public function show($id)
{
    $kuis = Kuis::with('questions')->findOrFail($id);

    return view('admin.kuis.show', compact('kuis'));
}

// ============================
// FORCE DELETE (HAPUS PERMANEN)
// ============================
public function forceDelete($id)
{
    $kuis = Kuis::onlyTrashed()->findOrFail($id);

    $kuis->forceDelete();

    return back()->with('success', 'Kuis berhasil dihapus permanen!');
}

}
