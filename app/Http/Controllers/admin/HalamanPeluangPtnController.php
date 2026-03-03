<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Universitas;
use App\Models\Prodi;
use Illuminate\Http\Request;

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
            }
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
        return response()->json(['message' => 'Import Berhasil']);
    }

    public function destroy($id)
    {
        $univ = Universitas::find($id);
        if ($univ) {
            $univ->update(['is_deleted' => true]);
            $univ->prodis()->where('is_deleted', false)->update(['is_deleted' => true, 'deleted_by_univ' => true]);
            return response()->json(['status' => 'success']);
        }

        $prodi = Prodi::find($id);
        if ($prodi) {
            $prodi->update(['is_deleted' => true, 'deleted_by_univ' => false]);
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
            return response()->json(['status' => 'success']);
        }

        $prodi = Prodi::find($id);
        if ($prodi) {
            $prodi->update(['is_deleted' => false, 'deleted_by_univ' => false]);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error'], 404);
    }

    public function forceDelete($id)
    {
        $univ = Universitas::find($id);
        if ($univ) {
            $univ->prodis()->delete();
            $univ->delete();
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