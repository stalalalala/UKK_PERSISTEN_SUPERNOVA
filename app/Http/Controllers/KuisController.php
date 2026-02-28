<?php

namespace App\Http\Controllers;

use App\Models\Kuis;
use App\Models\HasilKuis; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    /**
     * Menampilkan daftar kuis untuk peserta
     */
    public function index() {
        $allKuis = Kuis::withCount('questions')
            ->with(['hasil' => function($query) {
                // Mengambil hasil kuis milik user yang sedang login saja
                $query->where('user_id', Auth::id());
            }])
            ->where('is_active', true)
            ->orderBy('set_ke', 'asc') 
            ->paginate(6);

        return view('kuis.index', compact('allKuis'));
    }

    /**
     * Halaman instruksi sebelum mulai kuis
     */
    public function intruksi($id) {
        $kuis = Kuis::findOrFail($id);

        // BAGIAN PROTEKSI DIHAPUS/DIKOMENTARI 
        // Agar user bisa masuk ke sini saat klik tombol "Ulang"
        /*
        $sudahDikerjakan = HasilKuis::where('user_id', Auth::id())
                                    ->where('kuis_id', $id)
                                    ->exists();

        if ($sudahDikerjakan) {
            return redirect()->route('kuis.index')->with('info', 'Kamu sudah mengerjakan kuis ini!');
        }
        */

        return view('kuis.intruksi', compact('kuis'));
    }

    /**
     * Halaman pengerjaan soal
     */
    public function kerjakan($id) {
        $kuis = Kuis::with('questions')->findOrFail($id);
        return view('kuis.soal', compact('kuis'));
    }

    /**
     * Proses submit jawaban
     */
    public function submit(Request $request, $id) {
        $kuis = Kuis::with('questions')->findOrFail($id);
        
        // Decode JSON jawaban dari Alpine.js
        $jawabanUser = json_decode($request->input('jawaban'), true) ?? []; 

        $benar = 0;
        $salah = 0;
        $kosong = 0;
        $detailHasil = [];

        foreach ($kuis->questions as $q) {
            $userAns = $jawabanUser[$q->id] ?? null;
            
            if (empty($userAns)) {
                $kosong++;
                $status = 'kosong';
            } elseif (strtolower($userAns) == strtolower($q->jawaban_benar)) {
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

        $totalSoal = $kuis->questions->count();
        $skor = ($totalSoal > 0) ? ($benar / $totalSoal) * 100 : 0;

        // --- SIMPAN KE DATABASE (PERMANEN) ---
        // Menggunakan updateOrCreate agar jika user "Mengerjakan Ulang", 
        // skor lama akan diganti dengan skor baru (tidak duplikat row)
        HasilKuis::updateOrCreate(
            ['user_id' => Auth::id(), 'kuis_id' => $id], 
            [
                'benar'  => $benar,
                'salah'  => $salah,
                'kosong' => $kosong,
                'skor'   => round($skor),
            ]
        );

        // --- SIMPAN KE SESSION (UNTUK HALAMAN HASIL) ---
        session(['terakhir_kuis' => [
            'kuis_id' => $id,
            'benar'   => $benar,
            'salah'   => $salah,
            'kosong'  => $kosong,
            'detail'  => $detailHasil,
            'skor'    => round($skor)
        ]]);

        return redirect()->route('kuis.hasil', $id);
    }

    /**
     * Menampilkan hasil setelah submit
     */
    public function hasil($id) {
        $kuis = Kuis::findOrFail($id);
        $hasil = session('terakhir_kuis');

        // Jika session hilang (karena refresh), ambil data dari Database sebagai backup
        if (!$hasil || $hasil['kuis_id'] != $id) {
            $dbHasil = HasilKuis::where('user_id', Auth::id())
                                ->where('kuis_id', $id)
                                ->first();
            
            if (!$dbHasil) return redirect()->route('kuis.index');

            $hasil = [
                'kuis_id' => $dbHasil->kuis_id,
                'benar'   => $dbHasil->benar,
                'salah'   => $dbHasil->salah,
                'kosong'  => $dbHasil->kosong,
                'skor'    => $dbHasil->skor,
                'detail'  => [] // Detail soal tidak disimpan di DB untuk performa
            ];
        }

        return view('kuis.hasil', compact('kuis', 'hasil'));
    }
}