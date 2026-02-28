<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminTryout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutCategory;
use App\Models\SoalTryout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTryoutController extends Controller
{
    public function index() 
    {
        // Pastikan kolom 'is_active' ada di database, jika belum tambahkan lewat migrasi
        $tryouts = AdminTryout::with(['categories'])
            ->withCount(['categories', 'soals'])
            ->get();

        return view('admin.tryout.index', compact('tryouts'));
    }

    // Fungsi baru untuk mengubah status Aktif/Nonaktif
    public function toggleStatus($id)
    {
        $tryout = AdminTryout::findOrFail($id);
        
        // Membalikkan status (jika 1 jadi 0, jika 0 jadi 1)
        $tryout->is_active = !$tryout->is_active;
        $tryout->save();

        return redirect()->back()->with('success', 'Status Tryout berhasil diperbarui!');
    }

    public function create()
    {
        return view('admin.tryout.create');
    }

    public function store(Request $request)
    {
        $tryout = AdminTryout::create([
            'nama_tryout'   => $request->nama_tryout,
            'tanggal'       => $request->tanggal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'id_pengguna'   => Auth::id(),
            'is_active'     => 1 // Default aktif saat dibuat
        ]);

        $semuaData = json_decode($request->payload_full_data, true);
        if($semuaData) {
            foreach ($semuaData as $sub) {
                $category = TryoutCategory::create([
                    'admin_tryout_id' => $tryout->id,
                    'nama_kategori'   => $sub['name'],
                    'durasi'          => $sub['waktu'],
                ]);

                if (isset($sub['questions'])) {
                    foreach ($sub['questions'] as $s) {
                        if(!empty($s['pertanyaan'])){
                            SoalTryout::create([
                                'category_id'   => $category->id,
                                'materi_teks'   => $s['materi_teks'] ?? '',
                                'pertanyaan'    => $s['pertanyaan'],
                                'opsi_a'        => $s['opsi_a'],
                                'opsi_b'        => $s['opsi_b'],
                                'opsi_c'        => $s['opsi_c'],
                                'opsi_d'        => $s['opsi_d'],
                                'opsi_e'        => $s['opsi_e'],
                                'jawaban_benar' => $s['jawaban_benar'],
                                'pembahasan'    => $s['pembahasan'],
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('admin.tryout.index')->with('success', 'Tryout berhasil disimpan!');
    }

    public function edit($id)
    {
        $tryout = AdminTryout::with('categories.soals')->findOrFail($id);
        return view('admin.tryout.edit', compact('tryout'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $tryout = AdminTryout::findOrFail($id);
            $tryout->update([
                'nama_tryout'   => $request->nama_tryout,
                'tanggal'       => $request->tanggal,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            $semuaData = json_decode($request->payload_full_data, true);

            if ($semuaData) {
                foreach ($tryout->categories as $oldCat) {
                    SoalTryout::where('category_id', $oldCat->id)->delete();
                    $oldCat->delete();
                }

                foreach ($semuaData as $sub) {
                    $category = TryoutCategory::create([
                        'admin_tryout_id' => $tryout->id,
                        'nama_kategori'   => $sub['name'],
                        'durasi'          => $sub['waktu'],
                    ]);

                    if (isset($sub['questions'])) {
                        foreach ($sub['questions'] as $s) {
                            if (!empty($s['pertanyaan'])) {
                                SoalTryout::create([
                                    'category_id'   => $category->id,
                                    'materi_teks'   => $s['materi_teks'] ?? '',
                                    'pertanyaan'    => $s['pertanyaan'],
                                    'opsi_a'        => $s['opsi_a'],
                                    'opsi_b'        => $s['opsi_b'],
                                    'opsi_c'        => $s['opsi_c'],
                                    'opsi_d'        => $s['opsi_d'],
                                    'opsi_e'        => $s['opsi_e'],
                                    'jawaban_benar' => $s['jawaban_benar'],
                                    'pembahasan'    => $s['pembahasan'],
                                ]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.tryout.index')->with('success', 'Update Berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $adminTryout = AdminTryout::findOrFail($id);
        foreach ($adminTryout->categories as $category) {
            SoalTryout::where('category_id', $category->id)->delete();
            $category->delete();
        }
        $adminTryout->delete();
        return redirect()->route('admin.tryout.index')->with('success', 'Data dihapus!');
    }
}