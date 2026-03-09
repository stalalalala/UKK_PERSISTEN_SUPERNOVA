<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Universitas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class HalamanPeluangPtnController extends Controller
{
    public function index()
    {
        // Universitas aktif
        $univs = Universitas::with(['prodis' => function($q) {
                $q->where('is_deleted', false);
            }])
            ->where('is_deleted', false)
            ->orderBy('updated_at', 'desc') 
            ->get();

        // Riwayat Universitas
        $historyUniv = Universitas::where('is_deleted', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Riwayat Prodi
        $historyProdi = Prodi::with('universitas')
            ->where('is_deleted', true)
            ->orderBy('updated_at', 'desc')
            ->get();
        
        return view('admin/peluangPtn.index', compact('univs', 'historyUniv', 'historyProdi'));
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas Peluang PTN';

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
        $request->validate([
            'nama_univ' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        // Normalisasi kapitalisasi: univ kita -> Univ Kita
        $cleanUnivName = ucwords(strtolower(trim($request->nama_univ)));
        $cleanLokasi = ucwords(strtolower(trim($request->lokasi)));

        $univ = Universitas::find($request->id);

        if (!$univ) {
            $univ = Universitas::create([
                'nama_univ' => $cleanUnivName,
                'lokasi' => $cleanLokasi,
                'is_deleted' => false 
            ]);
        } else {
            $univ->timestamps = false; 
            $univ->update([
                'nama_univ' => $cleanUnivName,
                'lokasi' => $cleanLokasi,
                'is_deleted' => false 
            ]);
        }

        $isNew = !$request->id;
    $logAction = $isNew ? 'TAMBAH PTN' : 'UPDATE PTN';
    $logDesc = $isNew ? "Admin menambah PTN baru: $cleanUnivName" : "Admin memperbarui data PTN: $cleanUnivName";

        if ($request->has('prodis')) {
            foreach ($request->prodis as $p) {
                if (empty($p['nama'])) continue;

                $cleanProdiName = ucwords(strtolower(trim($p['nama'])));

                Prodi::updateOrCreate(
                    ['id' => $p['id'] ?? null], 
                    [
                        'universitas_id' => $univ->id, 
                        'nama_prodi' => $cleanProdiName,
                        'kuota' => $p['kuota'] ?? 0, 
                        'peminat' => $p['peminat'] ?? 0,
                        'is_deleted' => false,
                        'deleted_by_univ' => false
                    ]
                );

                $this->logAktivitas('TAMBAH PRODI PTN', $cleanProdiName, "Menambahkan prodi ke $cleanUnivName");
            }
        }else {
                $this->logAktivitas($logAction, $cleanUnivName, $logDesc);
        }
        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function importExcel(Request $request)
    {
        $data = $request->data; 

        foreach ($data as $row) {
            if (empty($row['Nama Universitas'])) continue;

            $cleanUnivName = ucwords(strtolower(trim($row['Nama Universitas'])));
            $cleanLokasi = isset($row['Lokasi']) ? ucwords(strtolower(trim($row['Lokasi']))) : '-';

            $univ = Universitas::where('nama_univ', $cleanUnivName)->first();

            if (!$univ) {
                $univ = Universitas::create([
                    'nama_univ' => $cleanUnivName,
                    'lokasi'    => $cleanLokasi,
                    'is_deleted'=> false
                ]);
            }

            if (!empty($row['Nama Prodi'])) {
                $cleanProdiName = ucwords(strtolower(trim($row['Nama Prodi'])));
                Prodi::create([
                    'universitas_id' => $univ->id,
                    'nama_prodi'     => $cleanProdiName,
                    'kuota'          => $row['Kuota'] ?? 0,
                    'peminat'        => $row['Peminat'] ?? 0,
                    'is_deleted'     => false,
                    'deleted_by_univ'=> false
                ]);
            }
        }

        $this->logAktivitas('IMPORT EXCEL PTN', 'Peluang PTN', "Admin melakukan import data PTN");

        return response()->json(['message' => 'Import Berhasil']);
    }

    public function destroy($id)
    {
        $univ = Universitas::find($id);
        if ($univ) {
            $name = $univ->nama_univ;
            $univ->update(['is_deleted' => true]);
            $univ->prodis()->where('is_deleted', false)->update(['is_deleted' => true, 'deleted_by_univ' => true]);

            $this->logAktivitas('HAPUS PTN', $name, "Memindahkan PTN dan seluruh prodinya ke riwayat", 'deleted');
            return response()->json(['status' => 'success']);
        }

        $prodi = Prodi::find($id);
        if ($prodi) {
            $name = $prodi->nama_prodi;
            $prodi->update(['is_deleted' => true, 'deleted_by_univ' => false]);

            $this->logAktivitas('HAPUS PRODI PTN', $name, "Memindahkan program studi ke riwayat", 'deleted');
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function restore($id)
    {
        $univ = Universitas::find($id);
        if ($univ) {
            $univ->update(['is_deleted' => false]);
            $univ->prodis()->where('deleted_by_univ', true)->update(['is_deleted' => false, 'deleted_by_univ' => false]);

            $this->logAktivitas('RESTORE PTN', $univ->nama_univ, "Memulihkan data PTN dari riwayat");
            return response()->json(['status' => 'success']);
        }

        $prodi = Prodi::find($id);
        if ($prodi) {
            $prodi->update(['is_deleted' => false, 'deleted_by_univ' => false]);

            $this->logAktivitas('RESTORE PTN', $univ->nama_univ, "Memulihkan data PTN dari riwayat");
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function forceDelete($id)
    {
        $univ = Universitas::find($id);
        if ($univ) {
            $name = $univ->nama_univ;
            $univ->prodis()->delete();
            $univ->delete();

            $this->logAktivitas('HAPUS PERMANEN PTN', $name, "Admin menghapus permanen data PTN dari database", 'deleted');
            return response()->json(['status' => 'success']);
        }

        $prodi = Prodi::find($id);
        if ($prodi) {
            $prodi->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }
}