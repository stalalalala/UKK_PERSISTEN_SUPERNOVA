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
            ->latest()
            ->get();

        $trash = Kuis::onlyTrashed()
            ->withCount('questions')
            ->latest()
            ->get();


        return view('admin.kuis.index', compact('kuis', 'trash'));
    }

    // ============================
    // CREATE FORM
    // ============================
    public function create()
    {
        return view('admin.kuis.create');
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

        if (!$questions || count($questions) < 2) {
            return back()->with('error', 'Harus mengisi minimal 20 soal!');
        }

        // ============================
        // AUTO SET NUMBER
        // ============================
        $lastSet = Kuis::where('kategori', $request->kategori)
            ->max('set_ke');

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
                'pertanyaan'    => $q['pertanyaan'],
                'subtes'        => $q['subtes'] ?? null,
                'opsi_a'        => $q['opsi_a'],
                'opsi_b'        => $q['opsi_b'],
                'opsi_c'        => $q['opsi_c'],
                'opsi_d'        => $q['opsi_d'],
                'opsi_e'        => $q['opsi_e'],
                'jawaban_benar' => $q['jawaban_benar'],
                'bobot'         => $q['bobot'] ?? 1,
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
            'pertanyaan' => $q->pertanyaan,
            'subtes' => $q->subtes,
            'materi' => $q->materi,

            'opsi_a' => $q->opsi_a,
            'opsi_b' => $q->opsi_b,
            'opsi_c' => $q->opsi_c,
            'opsi_d' => $q->opsi_d,
            'opsi_e' => $q->opsi_e,

            'jawaban_benar' => $q->jawaban_benar,
            'bobot' => $q->bobot,
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
                    'pertanyaan' => $q['pertanyaan'],
                    'subtes'     => $q['subtes'] ?? null,
                    'materi' => $q['materi'] ?? null,

                    'opsi_a' => $q['opsi_a'],
                    'opsi_b' => $q['opsi_b'],
                    'opsi_c' => $q['opsi_c'],
                    'opsi_d' => $q['opsi_d'],
                    'opsi_e' => $q['opsi_e'],

                    'jawaban_benar' => $q['jawaban_benar'],
                    'bobot'         => $q['bobot'] ?? 1,
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
        $kuis->delete();

        return back()->with('success', 'Kuis dipindahkan ke Trash!');
    }

    // ============================
    // RESTORE FROM TRASH
    // ============================
    public function restore($id)
    {
        $kuis = Kuis::onlyTrashed()->findOrFail($id);
        $kuis->restore();

        return back()->with('success', 'Kuis berhasil dipulihkan!');
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
