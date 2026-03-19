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
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class AdminMinatBakatController extends Controller
{
    public function index()
{
    $categories = MinatBakatKategori::withCount('soals')
        ->latest('updated_at') 
        ->get(); 
        
    $participants = MinatBakatPartisipan::latest()->get();
    
    $trashedCategories = MinatBakatKategori::onlyTrashed()
        ->latest('deleted_at')
        ->get();

    return view('admin.minatBakat.index', compact('categories', 'participants', 'trashedCategories'));
}

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas Minat Bakat';
        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul, 
            'description' => $deskripsi,
            'status'      => $status,
        ]);
    }

    public function store(Request $request)
    {
        $category = MinatBakatKategori::create([
            'name' => $request->name,
            'color' => $request->color,
            'description' => $request->description,
            'soal' => 0
        ]);

        $this->logAktivitas('TAMBAH MINAT BAKAT', $category->name, "Admin menambah kategori minat bakat baru");
        return response()->json($category);
    }

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

        $this->logAktivitas('UPDATE MINAT BAKAT', $kategori->name, "Admin memperbarui deskripsi/warna kategori");
        return response()->json($kategori);
    }

    public function destroy($id)
    {
        $category = MinatBakatKategori::find($id);
        if ($category) {
            $namaKategori = $category->name;
            // Soft delete soal terkait agar sinkron di history
            MinatBakatSoal::where('kategori_name', $namaKategori)->delete();
            $category->delete();
            
            $this->logAktivitas('HAPUS MINAT BAKAT', $namaKategori, "Admin menghapus kategori ke history", 'deleted');
            return response()->json(['success' => true]);
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    public function restore($id)
{
    $category = MinatBakatKategori::onlyTrashed()->find($id);
    if ($category) {
        MinatBakatSoal::onlyTrashed()->where('kategori_name', $category->name)->restore();
        
        $category->restore();
        $category->touch(); 

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}

    public function forceDelete($id)
    {
        $category = MinatBakatKategori::onlyTrashed()->find($id);
        if ($category) {
            // Hapus permanen soal terkait
            MinatBakatSoal::onlyTrashed()->where('kategori_name', $category->name)->forceDelete();
            $category->forceDelete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    public function manajemenSoal(Request $request) 
    {
        $categoryName = $request->query('category', 'Umum');
        $questions = MinatBakatSoal::where('kategori_name', $categoryName)->latest()->get();
        return view('admin.minatBakat.soal', compact('questions', 'categoryName'));
    }

    public function storeSoal(Request $request)
    {
        $request->validate(['text' => 'required', 'category' => 'required']);
        $soal = MinatBakatSoal::create([
            'kategori_name' => $request->category,
            'text' => $request->text
        ]);
        return response()->json($soal);
    }

    public function destroySoal($id)
    {
        MinatBakatSoal::destroy($id);
        return response()->json(['success' => true]);
    }

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
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
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
        MinatBakatPartisipan::truncate();
        DB::table('hasil_minat_bakats')->truncate();
        $this->logAktivitas('RESET DATA MINAT BAKAT', 'Database Partisipan', 'Admin membersihkan seluruh data hasil tes minat bakat peserta', 'deleted');
        return back()->with('success', 'Semua data peserta dan hasil berhasil direset!');
    }

    public function generatePdf($id)
    {
        $participant = MinatBakatPartisipan::findOrFail($id);
        $hasilTable = DB::table('hasil_minat_bakats')->where('id', $id)->first();
        $top_categories = [];
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
        $pdf = Pdf::loadView('admin.minatBakat.cetak_pdf', $data);
        return $pdf->stream('Laporan_'.$participant->name.'.pdf');
    }

    public function importSoalBulk(Request $request)
    {
        try {
            $rows = $request->data;
            if (!$rows || count($rows) <= 1) return response()->json(['success' => false, 'message' => 'File kosong'], 400);
            $count = 0;
            DB::beginTransaction();
            foreach ($rows as $index => $row) {
                if ($index === 0) continue;
                $pertanyaan = $row[1] ?? null;
                $kategori   = $row[2] ?? null;
                if (!empty($pertanyaan) && !empty($kategori)) {
                    MinatBakatSoal::create(['text' => trim($pertanyaan), 'kategori_name' => trim($kategori)]);
                    $count++;
                }
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => "Berhasil mengimpor $count soal!"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}