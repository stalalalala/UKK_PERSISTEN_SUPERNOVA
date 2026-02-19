<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\AdminMinatBakat;
use App\Models\MinatBakatKategori;
use App\Models\MinatBakatPartisipan;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\MinatBakatSoal;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminMinatBakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // Hapus ->withCount('soals')
    public function index()
{
    // Mengambil kategori sambil menghitung jumlah soal yang terkait
    // Asumsi: Nama relasi di Model MinatBakatKategori adalah 'soals'
    $categories = MinatBakatKategori::withCount('soals')->get(); 
    
    $participants = MinatBakatPartisipan::latest()->get();

    return view('admin.minatbakat.index', compact('categories', 'participants'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = MinatBakatKategori::create([
            'name' => $request->name,
            'color' => $request->color,
            'soal' => 0
        ]);

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminMinatBakat $adminMinatBakat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminMinatBakat $adminMinatBakat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'color' => 'required'
        ]);

        $kategori = MinatBakatKategori::findOrFail($id);
        $kategori->update([
            'name' => $request->name,
            'description' => $request->description,
            'color' => $request->color
        ]);

        return response()->json($kategori);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Temukan kategori berdasarkan ID
    $category = MinatBakatKategori::find($id);

    if ($category) {
        $category->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['message' => 'Data tidak ditemukan'], 404);
}

    public function manajemenSoal(Request $request) 
    {
        $categoryName = $request->query('category', 'Umum');
        // Ambil soal yang hanya sesuai kategori ini
        $questions = MinatBakatSoal::where('kategori_name', $categoryName)->latest()->get();
        
        return view('admin.minatbakat.soal', compact('questions', 'categoryName'));
    }

    public function storeSoal(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'category' => 'required'
        ]);

        $soal = MinatBakatSoal::create([
            'kategori_name' => $request->category,
            'text' => $request->text
        ]);

        return response()->json($soal);
    }

    // Hapus (Masuk ke History)
    public function destroySoal($id)
    {
        // Jika Anda ingin benar-benar 'menghapus' dari daftar utama tapi tetap ada di history UI saja:
        MinatBakatSoal::destroy($id);
        return response()->json(['success' => true]);
    }

    // Pulihkan (Simpan ulang ke database)
    public function restoreSoal(Request $request)
    {
        $soal = MinatBakatSoal::create([
            'kategori_name' => $request->category,
            'text' => $request->text
        ]);
        return response()->json($soal);
    }

    public function exportPartisipan()
{
    $fileName = 'laporan-partisipan-' . date('Y-m-d') . '.csv';
    $participants = MinatBakatPartisipan::all();

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['ID', 'Nama', 'Hasil', 'Tanggal'];

    $callback = function() use($participants, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($participants as $p) {
            fputcsv($file, [$p->id, $p->name, $p->hasil, $p->created_at]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function resetPartisipan()
{
    // 1. Menghapus data dari tabel partisipan
    MinatBakatPartisipan::truncate();

    // 2. Menghapus juga data dari tabel hasil (Gunakan DB karena mungkin tidak ada modelnya)
    DB::table('hasil_minat_bakats')->truncate();

    return back()->with('success', 'Semua data peserta dan hasil berhasil direset!');
}

public function generatePdf($id)
{
    // Ambil data orang (ID 1, 2, dst)
    $participant = MinatBakatPartisipan::findOrFail($id);
    
    // Ambil data hasil (Cari yang ID-nya sama dengan partisipan)
    $hasilTable = DB::table('hasil_minat_bakats')->where('id', $id)->first();

    $top_categories = [];

    // Jika tabel hasil ada isinya
    if ($hasilTable) {
        $top_names = [$hasilTable->top_1, $hasilTable->top_2, $hasilTable->top_3];

        foreach ($top_names as $name) {
            if (!empty($name)) {
                $catInfo = MinatBakatKategori::where('name', 'like', trim($name))->first();
                $top_categories[] = (object)[
                    'name' => strtoupper($name),
                    'description' => $catInfo->description ?? "Memiliki potensi yang sangat baik pada bidang " . strtoupper($name) . "."
                ];
            }
        }
    }

    $data = [
        'nama' => $participant->name,
        'tanggal' => $participant->created_at->format('d F Y'),
        'hasil' => strtoupper($participant->hasil),
        'top_categories' => $top_categories
    ];

    $pdf = Pdf::loadView('admin.minatbakat.cetak_pdf', $data);
    return $pdf->stream('Laporan_'.$participant->name.'.pdf');
}

public function importSoalBulk(Request $request)
{
    try {
        // 1. Validasi file (Pastikan yang diupload adalah CSV)
        if (!$request->hasFile('file')) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan'], 400);
        }

        $file = $request->file('file');
        $path = $file->getRealPath();

        // 2. Buka file CSV
        $handle = fopen($path, "r");
        $count = 0;
        $isHeader = true;

        // 3. Mulai Transaksi Database (Supaya aman kalau ada error di tengah jalan)
        DB::beginTransaction();

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Lewati baris pertama (Judul Kolom)
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            // Asumsi struktur file CSV kamu:
            // Kolom 0: No | Kolom 1: Pertanyaan | Kolom 2: Nama Kategori
            $pertanyaan = $row[1] ?? null;
            $kategori   = $row[2] ?? null;

            if (!empty($pertanyaan) && !empty($kategori)) {
                \App\Models\MinatBakatSoal::create([
                    'text'          => $pertanyaan,
                    'kategori_name' => trim($kategori)
                ]);
                $count++;
            }
        }

        fclose($handle);
        DB::commit(); // Simpan perubahan ke database

        return response()->json([
            'success' => true,
            'message' => "Alhamdulillah! Berhasil mengimpor $count soal."
        ]);

    } catch (\Exception $e) {
        DB::rollBack(); // Batalkan jika ada error
        return response()->json([
            'success' => false,
            'message' => "Gagal: " . $e->getMessage()
        ], 500);
    }
}
}
