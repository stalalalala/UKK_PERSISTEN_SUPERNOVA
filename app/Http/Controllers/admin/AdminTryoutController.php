<?php

namespace App\Http\Controllers\admin;

use App\Models\AdminTryout;
use App\Models\SystemLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TryoutCategory;
use App\Models\SoalTryout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminTryoutController extends Controller
{
    /**
     * Helper untuk mencatat log aktivitas agar tersambung ke Monitoring Laporan
     */

    public function index() 
    {
        $tryouts = AdminTryout::with(['categories'])
            ->withCount(['categories', 'soals'])
            ->get();

        return view('admin.tryout.index', compact('tryouts'));
    }

    private function logAktivitas($aksi, $judul, $deskripsi, $status = 'active')
    {
        $fixJudul = $judul ?? 'Aktivitas Tryout';

        SystemLog::create([
            'id_pengguna' => Auth::id(),
            'category'    => $aksi,
            'title'       => $fixJudul, 
            'description' => $deskripsi,
            'status'      => $status,
        ]);
    }

    public function toggleStatus($id)
    {
        $tryout = AdminTryout::findOrFail($id);
        
        $tryout->is_active = !$tryout->is_active;
        $tryout->save();

        $statusAction = $tryout->is_active ? 'MENGAKTIFKAN' : 'MENONAKTIFKAN';

        // Log Aktivitas
        $this->logAktivitas(
            $statusAction . ' TRYOUT', 
            $tryout->nama_tryout, 
            'Admin mengubah status aksesibilitas tryout agar ' . ($tryout->is_active ? 'bisa' : 'tidak bisa') . ' diakses user.'
        );

        return redirect()->back()->with('success', 'Status Tryout berhasil diperbarui!');
    }

    public function create()
    {
        return view('admin.tryout.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $tryout = AdminTryout::create([
                'nama_tryout'   => $request->nama_tryout,
                'tanggal'       => $request->tanggal,
                'tanggal_akhir' => $request->tanggal_akhir,
                'id_pengguna'   => Auth::id(),
                'is_active'     => 1 
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

            // Log Aktivitas
            $this->logAktivitas(
                'TAMBAH TRYOUT', 
                $tryout->nama_tryout, 
                'Admin berhasil menambahkan paket tryout baru ke dalam sistem.'
            );

            DB::commit();
            return redirect()->route('admin.tryout.index')->with('success', 'Tryout berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal simpan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $tryout = AdminTryout::with('categories.soals')->findOrFail($id);
        return view('admin.tryout.edit', compact('tryout'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('payload_full_data')) {
            return back()->with('error', 'Data soal tidak ditemukan.');
        }

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

            // Log Aktivitas
            $this->logAktivitas(
                'UPDATE TRYOUT', 
                $tryout->nama_tryout, 
                'Admin mengubah konten atau pengaturan pada paket tryout.'
            );

            DB::commit();
            return redirect()->route('admin.tryout.index')->with('success', 'Update Berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $adminTryout = AdminTryout::findOrFail($id);
            $nama_tryout = $adminTryout->nama_tryout;

            foreach ($adminTryout->categories as $category) {
                SoalTryout::where('category_id', $category->id)->delete();
                $category->delete();
            }
            $adminTryout->delete();

            // Log Aktivitas
            $this->logAktivitas(
                'HAPUS TRYOUT', 
                $nama_tryout, 
                'Admin menghapus permanen seluruh data terkait paket tryout ini.',
                'deleted'
            );

            DB::commit();
            return redirect()->route('admin.tryout.index')->with('success', 'Data dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }
}