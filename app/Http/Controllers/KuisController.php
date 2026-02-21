<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use Illuminate\Http\Request;

class KuisController extends Controller
{
    
    public function index() {
    $allKuis = Kuis::withCount('questions')
                ->where('is_active', true)
                ->orderBy('set_ke', 'asc') 
                ->paginate(6);

    return view('kuis.index', compact('allKuis'));
}

public function intruksi($id) {
    $kuis = Kuis::findOrFail($id);
    return view('kuis.intruksi', compact('kuis'));
}

public function kerjakan($id) {
    // Ambil kuis dan 20 soalnya
    $kuis = Kuis::with('questions')->findOrFail($id);
    return view('kuis.soal', compact('kuis'));
}

public function submit(Request $request, $id) {
    $kuis = Kuis::with('questions')->findOrFail($id);
    $jawabanUser = $request->input('jawaban', []); // format: [question_id => 'A']

    $benar = 0;
    $salah = 0;
    $kosong = 0;
    $detailHasil = [];

    foreach ($kuis->questions as $q) {
        $userAns = $jawabanUser[$q->id] ?? null;
        
        if (!$userAns) {
            $kosong++;
            $status = 'kosong';
        } elseif ($userAns == $q->jawaban_benar) {
            $benar++;
            $status = 'benar';
        } else {
            $salah++;
            $status = 'salah';
        }

        $detailHasil[] = [
            'pertanyaan' => $q->pertanyaan,
            'jawaban_user' => $userAns,
            'kunci' => $q->jawaban_benar,
            'status' => $status
        ];
    }

    // Simpan hasil ke session sementara untuk ditampilkan di blade hasil
    session(['terakhir_kuis' => [
        'kuis_id' => $id,
        'benar' => $benar,
        'salah' => $salah,
        'kosong' => $kosong,
        'detail' => $detailHasil,
        'skor' => ($benar / $kuis->questions->count()) * 100
    ]]);

    return redirect()->route('kuis.hasil', $id);
}

public function hasil($id) {
    // 1. Ambil data kuis
    $kuis = Kuis::findOrFail($id);
    
    // 2. Ambil data skor dari session yang dibuat di fungsi submit
    $hasil = session('terakhir_kuis');

    // 3. Validasi: Jika session kosong (misal user refresh halaman), kembalikan ke index
    if (!$hasil || $hasil['kuis_id'] != $id) {
        return redirect()->route('kuis.index');
    }

    // 4. Kirim data ke blade
    return view('kuis.hasil', compact('kuis', 'hasil'));
}

}