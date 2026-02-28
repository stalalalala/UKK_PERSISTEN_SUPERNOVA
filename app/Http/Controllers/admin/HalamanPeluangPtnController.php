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
        // Mengambil data univ beserta prodi didalamnya
        $univs = Universitas::with('prodis')->get();
        return view('admin/peluangPtn.index', compact('univs'));
    }

    public function store(Request $request)
    {
        // Simpan Universitas baru atau update jika sudah ada
        $univ = Universitas::updateOrCreate(['nama_univ' => $request->nama_univ]);

        // Simpan Prodi
        foreach ($request->prodis as $p) {
            Prodi::updateOrCreate(
                [
                    'universitas_id' => $univ->id,
                    'nama_prodi' => $p['nama']
                ],
                [
                    'kuota' => $p['kuota'],
                    'peminat' => $p['peminat']
                ]
            );
        }

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

    public function destroy($id)
    {
        Universitas::findOrFail($id)->delete();
        return response()->json(['message' => 'Data dihapus']);
    }
}