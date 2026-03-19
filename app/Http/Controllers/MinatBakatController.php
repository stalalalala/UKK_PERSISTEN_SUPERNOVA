<?php

namespace App\Http\Controllers;

use App\Models\MinatBakat;
use App\Models\HasilMinatBakat;
use App\Models\MinatBakatSoal;
use App\Models\MinatBakatKategori;
use App\Models\MinatBakatPartisipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class MinatBakatController extends Controller
{
    public function intruksi()
    {
        // CEK: Jika sudah pernah tes, langsung lempar ke halaman hasil
        $sudahTes = HasilMinatBakat::where('user_id', Auth::id())->exists();
        if ($sudahTes) {
            return redirect()->route('minatbakat.hasil');
        }

        return view('minatbakat.intruksi');
    }

    public function index() 
    {
        // CEK: Proteksi jika user mencoba akses URL /soal secara manual
        $sudahTes = HasilMinatBakat::where('user_id', Auth::id())->exists();
        if ($sudahTes) {
            return redirect()->route('minatbakat.hasil');
        }

        $seed = crc32(session()->getId());

        $soals = MinatBakatSoal::distinct()
                    ->inRandomOrder($seed)
                    ->get(); 
        
        $totalSoal = $soals->count();
        
        return view('minatbakat.soal', compact('soals', 'totalSoal'));
    }

    public function store(Request $request) 
    {
        // CEK: Mencegah submit ganda atau kecurangan via post tools
        if (HasilMinatBakat::where('user_id', Auth::id())->exists()) {
            return redirect()->route('minatbakat.hasil');
        }

        $request->validate(['jawaban' => 'required|array']);
        $jawaban = $request->input('jawaban'); 

        $skor = [];

        foreach ($jawaban as $soalId => $nilai) {
            $soal = MinatBakatSoal::find($soalId);
            if ($soal) {
                $kat = $soal->kategori_name;
                if (!isset($skor[$kat])) $skor[$kat] = 0;
                $skor[$kat] += (int)$nilai;
            }
        }

        arsort($skor);
        $top3 = array_slice(array_keys($skor), 0, 3);

        $hasil = HasilMinatBakat::create([
            'user_id' => Auth::id(),
            'top_1' => $top3[0],
            'top_2' => $top3[1] ?? '-',
            'top_3' => $top3[2] ?? '-',
        ]);

        MinatBakatPartisipan::create([
            'name' => Auth::user()->name ?? 'Guest',
            'tgl' => now()->format('d M Y'),
            'hasil' => $top3[0],
            'skor' => '100%',
        ]);

        return redirect()->route('minatbakat.hasil');
    }

    public function hasil() 
    {
        $hasil = HasilMinatBakat::where('user_id', Auth::id())->latest()->first();

        // Jika belum pernah tes tapi paksa buka halaman hasil, lempar ke instruksi
        if (!$hasil) {
            return redirect()->route('minatbakat.intruksi')->with('error', 'Silahkan ikuti tes terlebih dahulu.');
        }

        $categories = MinatBakatKategori::all(); 

        return view('minatbakat.hasil', compact('hasil', 'categories'));
    }

    public function downloadPdf()
    {
        $hasil = HasilMinatBakat::where('user_id', Auth::id())->latest()->first();

        if (!$hasil) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $top_categories = [];
        $top_names = [$hasil->top_1, $hasil->top_2, $hasil->top_3];

        foreach ($top_names as $name) {
            if (!empty($name) && $name !== '-') {
                $catInfo = MinatBakatKategori::where('name', $name)->first();
                $top_categories[] = (object)[
                    'name' => strtoupper($name),
                    'description' => $catInfo->description ?? "Memiliki potensi yang sangat baik pada bidang " . strtoupper($name) . "."
                ];
            }
        }

        $data = [
            'nama' => Auth::user()->name,
            'tanggal' => $hasil->created_at->format('d F Y'),
            'hasil' => strtoupper($hasil->top_1),
            'top_categories' => $top_categories
        ];

        $pdf = Pdf::loadView('admin.minatBakat.cetak_pdf', $data);
        return $pdf->stream('Laporan_Hasil_'.Auth::user()->name.'.pdf');
    }
}