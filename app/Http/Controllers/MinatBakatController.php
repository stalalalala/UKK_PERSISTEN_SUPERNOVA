<?php

namespace App\Http\Controllers;

use App\Models\MinatBakat;
use App\Models\HasilMinatBakat; // Pastikan Model ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinatBakatController extends Controller
{
    public function index() {
    $seed = crc32(session()->getId());

    $soals = \App\Models\MinatBakatSoal::distinct()
                ->inRandomOrder($seed)
                ->get(); 
    
    $totalSoal = $soals->count();
    
    return view('minatbakat.soal', compact('soals', 'totalSoal'));
}

public function store(Request $request) {
    $request->validate(['jawaban' => 'required|array']);
    $jawaban = $request->input('jawaban'); 

    $skor = [];

    foreach ($jawaban as $soalId => $nilai) {
        // Cari soal berdasarkan ID asli di database
        $soal = \App\Models\MinatBakatSoal::find($soalId);
        if ($soal) {
            $kat = $soal->kategori_name; // Sesuai kolom di tabel Admin
            if (!isset($skor[$kat])) $skor[$kat] = 0;
            $skor[$kat] += (int)$nilai;
        }
    }

    arsort($skor);
    $top3 = array_slice(array_keys($skor), 0, 3);

    // Simpan ke hasil dan juga ke tabel Partisipan agar muncul di dashboard Admin
    $hasil = \App\Models\HasilMinatBakat::create([
        'user_id' => Auth::id(),
        'top_1' => $top3[0],
        'top_2' => $top3[1] ?? '-',
        'top_3' => $top3[2] ?? '-',
    ]);

    // Tambahkan data ke MinatBakatPartisipan supaya muncul di tabel Admin "Peserta Terbaru"
    \App\Models\MinatBakatPartisipan::create([
        'name' => Auth::user()->name ?? 'Guest',
        'tgl' => now()->format('d M Y'),
        'hasil' => $top3[0], // Ambil yang paling dominan
        'skor' => '100%', // Anda bisa hitung persentase jika perlu
    ]);

    return redirect()->route('minatbakat.hasil');
}

    public function hasil() {
    // Ambil hasil terbaru user
    $hasil = HasilMinatBakat::where('user_id', Auth::id())->latest()->first();

    if (!$hasil) {
        return redirect()->route('minatbakat.index')->with('error', 'Silahkan ikuti tes terlebih dahulu.');
    }

    $categories = \App\Models\MinatBakatKategori::all(); 
    

    return view('minatbakat.hasil', compact('hasil', 'categories'));
}
    public function intruksi()
    {
        return view('minatbakat.intruksi');
    }
}