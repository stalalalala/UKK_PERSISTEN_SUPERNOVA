<?php

namespace App\Http\Controllers;

use App\Models\HasilLatihan;
use App\Models\Latihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    /* =========================
       INDEX - LIST PER SUBTES
    ========================== */
    public function index()
    {
        $latihans = Latihan::where('is_published', true)
            ->where('is_active', true)
            ->withCount('questions')
            ->orderBy('subtes')
            ->orderBy('set_ke')
            ->get()
            ->groupBy('subtes'); // tetap per subtes

        $subtesMap = [
            'Penalaran Umum' => 'PU',
            'Pengetahuan & Pemahaman Umum' => 'PPU',
            'Pemahaman Bacaan & Menulis' => 'PBM',
            'Pengetahuan Kuantitatif' => 'PK',
            'Penalaran Matematika' => 'PM',
            'Literasi Bahasa Indonesia' => 'LBI',
            'Literasi Bahasa Inggris' => 'LBE',
        ];

        return view('latihan.index', compact('latihans', 'subtesMap'));
    }

    /* =========================
       INTRUKSI PER SUBTES
    ========================== */
    public function intruksi($id)
    {
        $latihan = Latihan::withCount('questions')
            ->where('is_active', true)
            ->where('is_published', true)
            ->findOrFail($id);

        return view('latihan.intruksi', compact('latihan'));
    }

    /* =========================
       SOAL PER SUBTES
    ========================== */
    public function soal($id)
    {
        $latihan = Latihan::with(['questions' => function ($q) {
                $q->orderBy('id');
            }])
            ->where('is_active', true)
            ->where('is_published', true)
            ->findOrFail($id);

        return view('latihan.soal', compact('latihan'));
    }

    /* =========================
       SUBMIT PER SUBTES
    ========================== */
    public function submit(Request $request, $id)
{
    $latihan = Latihan::with('questions')
        ->where('is_active', true)
        ->where('is_published', true)
        ->findOrFail($id);

    $jawabanUser = $request->input('jawaban', []);

if (!is_array($jawabanUser)) {
    $jawabanUser = [];
}

    $benar = 0;
    $total = $latihan->questions->count();

    foreach ($latihan->questions as $soal) {
        if (
            isset($jawabanUser[$soal->id]) &&
            $jawabanUser[$soal->id] === $soal->jawaban_benar
        ) {
            $benar++;
        }
    }

    $salah = $total - $benar;
    $kosong = $total - count($jawabanUser);

    $skor = $total > 0 ? round(($benar / $total) * 100) : 0;

    // 🔥 SIMPAN KE DATABASE
    HasilLatihan::create([
        'user_id'    => Auth::id(),
        'latihan_id' => $latihan->id,
        'skor'       => $skor,
        'benar'      => $benar,
        'salah'      => $salah,
        'kosong'     => $kosong,
    ]);

    return redirect()->route('latihan.hasil', $latihan->id);
}

    /* =========================
       HASIL PER SUBTES
    ========================== */

public function hasil($id)
{
    $latihan = Latihan::findOrFail($id);

    $hasil = HasilLatihan::where('user_id', Auth::id())
                ->where('latihan_id', $id)
                ->latest()
                ->first();

    if (!$hasil) {
        return redirect()->route('latihan.index');
    }

    return view('latihan.hasil', compact('latihan', 'hasil'));
}
}