<?php

namespace App\Http\Controllers;

use App\Models\HasilLatihan;
use App\Models\Latihan;
use App\Services\XpService;
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
        ->with('userHasil') // Memanggil relasi hasil milik user login
        ->orderBy('subtes')
        ->orderBy('set_ke')
        ->get()
        ->groupBy('subtes');

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
    $latihan = Latihan::with('questions')->findOrFail($id);

    $jawabanUser = json_decode($request->input('jawaban'), true) ?? [];

    $benar = 0;
    $salah = 0;
    $kosong = 0;

    foreach ($latihan->questions as $q) {
        $userAns = $jawabanUser[$q->id] ?? null;

        if (empty($userAns)) {
            $kosong++;
        } elseif (strtolower(trim($userAns)) == strtolower(trim($q->jawaban_benar))) {
            $benar++;
        } else {
            $salah++;
        }
    }

    $totalSoal = $latihan->questions->count();
    $skor = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;

    $hasilRecord = HasilLatihan::updateOrCreate(
        [
            'user_id'    => Auth::id(),
            'latihan_id' => $id
        ],
        [
            'benar'         => $benar,
            'salah'         => $salah,
            'kosong'        => $kosong,
            'skor'          => $skor,
            'list_jawaban'  => json_encode($jawabanUser),
        ]
    );

    // 🔥 TAMBAHKAN XP DI SINI (SEBELUM RETURN)
    $xpService = new XpService();
    $xpService->addXp(Auth::user(), 'latihan', 20);

    return view('latihan.hasil', [
        'latihan'     => $latihan,
        'hasil'       => $hasilRecord,
        'jawabanUser' => $jawabanUser
    ]);
}

/* =========================
   HASIL PER SUBTES (View History)
========================== */
public function hasil($id)
{
    $latihan = Latihan::with('questions')->findOrFail($id);

    $hasil = HasilLatihan::where('user_id', Auth::id())
                ->where('latihan_id', $id)
                ->first();

    if (!$hasil) {
        return redirect()->route('latihan.index');
    }

    // AMBIL KEMBALI JAWABAN YANG DISIMPAN DI DATABASE
    $jawabanUser = json_decode($hasil->list_jawaban, true) ?? [];

    return view('latihan.hasil', [
        'latihan'     => $latihan, 
        'hasil'       => $hasil,
        'jawabanUser' => $jawabanUser // Sekarang data tidak akan null lagi
    ]);
}
}