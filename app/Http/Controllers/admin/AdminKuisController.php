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

        if (!$questions || count($questions) < 20) {
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

        return view('admin.kuis.edit', compact('kuis'));
    }

    // ============================
    // UPDATE QUIZ + QUESTIONS OPTIONAL
    // ============================
    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        // update kuis opsional
        $kuis->update([
            'durasi'    => $request->durasi ?? $kuis->durasi,
            'materi'    => $request->materi ?? $kuis->materi,
            'video_url' => $request->video_url ?? $kuis->video_url,
        ]);

        // update soal opsional
        if ($request->questions) {

            foreach ($request->questions as $qid => $q) {

                $question = $kuis->questions()->find($qid);

                if ($question) {
                    $question->update([
                        'pertanyaan' => $q['pertanyaan'] ?? $question->pertanyaan,

                        'opsi_a' => $q['opsi_a'] ?? $question->opsi_a,
                        'opsi_b' => $q['opsi_b'] ?? $question->opsi_b,
                        'opsi_c' => $q['opsi_c'] ?? $question->opsi_c,
                        'opsi_d' => $q['opsi_d'] ?? $question->opsi_d,
                        'opsi_e' => $q['opsi_e'] ?? $question->opsi_e,

                        'jawaban_benar' => $q['jawaban_benar'] ?? $question->jawaban_benar,
                        'bobot' => $q['bobot'] ?? $question->bobot,
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
}
