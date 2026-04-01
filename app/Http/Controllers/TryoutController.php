<?php

namespace App\Http\Controllers;

use App\Models\AdminTryout;
use App\Models\SoalTryout;
use App\Services\XpService;
use App\Models\Universitas;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TryoutController extends Controller
{
    /**
     * Menampilkan daftar Tryout yang tersedia.
     */
    public function index() 
    {
        $now = Carbon::now();
        $userId = Auth::id();

        // 1. Ambil target tryout user
        $userTarget = DB::table('user_target_tryouts')
            ->join('prodis', 'user_target_tryouts.prodi_id', '=', 'prodis.id')
            ->join('universitas', 'prodis.universitas_id', '=', 'universitas.id')
            ->where('user_id', $userId)
            ->select(
                'universitas.nama_univ', 
                'prodis.nama_prodi', 
                'prodis.id as prodi_id', 
                'prodis.kuota', 
                'prodis.peminat',
                'universitas.id as universitas_id'
            )
            ->first();

        // 2. LOGIKA PELUANG LOLOS (AKUMULASI NILAI + KEKETATAN JURUSAN)
        $peluangLolos = 0;

        if ($userTarget) {
            // Ambil data performa user dari semua jawaban yang pernah dikerjakan
            $userScores = DB::table('tryout_jawaban_peserta')
                ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
                ->where('tryout_jawaban_peserta.user_id', $userId)
                ->select(
                    'soal_tryouts.category_id',
                    DB::raw('COUNT(CASE WHEN is_correct = 1 THEN 1 END) as benar'),
                    DB::raw('COUNT(*) as total_soal')
                )
                ->groupBy('soal_tryouts.category_id')
                ->get();

            // Peluang 0% jika belum mengerjakan TO sama sekali (userScores kosong)
            if ($userScores->count() > 0) {
                // A. Faktor Keketatan Jurusan (Bobot 30%)
                // Rumus: (Kuota / Peminat) * 30. Contoh: (50/1000) * 30 = 1.5%
                $scoreJurusan = ($userTarget->peminat > 0) ? ($userTarget->kuota / $userTarget->peminat) * 30 : 0;

                // B. Faktor Performa Akumulasi (Bobot 70%)
                // Hitung rata-rata nilai dari seluruh subtes/TO yang pernah diikuti
                $totalRataRata = $userScores->map(function($item) {
                    return ($item->total_soal > 0) ? ($item->benar / $item->total_soal) * 1000 : 0;
                })->avg();

                // Kita asumsikan skor 750 adalah angka aman (Passing Grade ideal)
                // Rumus: (Rata-rata Skor / 750) * 70
                $scorePerforma = ($totalRataRata / 750) * 70;

                // C. Total Gabungan
                $peluangLolos = round($scoreJurusan + $scorePerforma);

                // Keamanan: Batasi maksimal 98% (karena UTBK tidak pernah 100% pasti)
                if ($peluangLolos > 98) $peluangLolos = 98;
                // Jika sudah mengerjakan tapi hasil sangat kecil, tetap beri minimal 1%
                if ($peluangLolos < 1) $peluangLolos = 1;
            } else {
                // Jika userTarget ada tapi belum mengerjakan TO sama sekali, peluang 0%
                $peluangLolos = 0;
            }
        }

        // 3. Ambil data Universitas & Prodi untuk Dropdown
        $allUnivs = Universitas::with(['prodis' => function($q) {
                $q->where('is_deleted', false);
            }])
            ->where('is_deleted', false)
            ->get();

        // 4. Ambil semua tryout untuk ditampilkan di list
        $tryouts = AdminTryout::orderBy('id', 'asc')->get();

        // 5. Identifikasi Tryout yang sudah dikerjakan
        $userResults = DB::table('tryout_jawaban_peserta')
            ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
            ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
            ->where('tryout_jawaban_peserta.user_id', $userId)
            ->select('tryout_categories.admin_tryout_id as tryout_id')
            ->distinct()
            ->pluck('tryout_id') 
            ->toArray();

        // 6. Ambil 3 TO terbaru untuk section "Terbaru"
        $latestTryouts = AdminTryout::where('is_active', true)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get()
            ->map(function ($to) use ($now, $userId, $userResults) {
                $to->sudah_dikerjakan = in_array($to->id, $userResults);
                $to->is_open = ($to->tanggal <= $now && $to->tanggal_akhir >= $now) && !$to->sudah_dikerjakan;
                $to->is_locked = !DB::table('user_target_tryouts')->where('user_id', $userId)->exists();
                return $to;
            });

        // 7. Transform status Tryout di list utama
        $tryouts->transform(function ($item) use ($now, $userResults, $userTarget) {
            $isWithinDate = ($now >= $item->tanggal && $now <= $item->tanggal_akhir);
            $sudahDikerjakan = in_array($item->id, $userResults);

            $item->is_available = ($item->is_active && $isWithinDate && !$sudahDikerjakan && $userTarget);
            $item->is_locked_by_target = !$userTarget;
            $item->sudah_dikerjakan = $sudahDikerjakan;

            return $item;
        });

        return view('tryout.index', compact('tryouts', 'userResults', 'userTarget', 'peluangLolos', 'allUnivs', 'latestTryouts'));
    }

    /**
     * Simpan atau Update Target Tryout Peserta
     */
    public function updateTarget(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id'
        ]);
        
        // Simpan ke tabel user_target_tryouts
        DB::table('user_target_tryouts')->updateOrInsert(
            ['user_id' => Auth::id()],
            [
                'prodi_id' => $request->prodi_id,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return response()->json(['status' => 'success', 'message' => 'Target Tryout berhasil diperbarui']);
    }

    /**
     * Menampilkan halaman instruksi sebelum mulai.
     */
    public function intruksi($id) 
    {
        $tryout = AdminTryout::findOrFail($id);
        $userId = Auth::id();

        // Keamanan: Cek apakah user sudah mengisi target tryout
        $hasTarget = DB::table('user_target_tryouts')->where('user_id', $userId)->exists();
        if (!$hasTarget) {
            return redirect()->route('tryout.index')->with('error', 'Silakan pilih Universitas & Jurusan terlebih dahulu.');
        }
        
        $sudahDikerjakan = DB::table('tryout_jawaban_peserta')
            ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
            ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
            ->where('tryout_jawaban_peserta.user_id', $userId)
            ->where('tryout_categories.admin_tryout_id', $id)
            ->exists();

        if ($sudahDikerjakan) {
            return redirect()->route('tryout.hasil', $id)->with('info', 'Anda sudah menyelesaikan Try Out ini.');
        }

        $firstCategory = DB::table('tryout_categories')
                            ->where('admin_tryout_id', $id)
                            ->orderBy('id', 'asc')
                            ->first();

         // 🔹 HITUNG TOTAL SOAL
    $totalSoal = DB::table('soal_tryouts')
        ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
        ->where('tryout_categories.admin_tryout_id', $id)
        ->count();

    // 🔹 HITUNG TOTAL DURASI
    $totalDurasi = DB::table('tryout_categories')
        ->where('admin_tryout_id', $id)
        ->sum('durasi');

    return view('tryout.intruksi', compact(
        'tryout',
        'firstCategory',
        'totalSoal',
        'totalDurasi'
    ));
    }

    public function soal($id, $category_id = null) 
{
    $tryout = AdminTryout::findOrFail($id);
    
    $categories = DB::table('tryout_categories')
        ->where('admin_tryout_id', $id)
        ->orderBy('id', 'asc')
        ->get();

    if ($categories->isEmpty()) {
        return redirect()->route('tryout.index')->with('error', 'Kategori (Subtes) belum tersedia.');
    }

    if (!$category_id) {
        $currentCategory = $categories->first();
    } else {
        $currentCategory = DB::table('tryout_categories')->where('id', $category_id)->first();
    }

    $soals = SoalTryout::where('category_id', $currentCategory->id)->get();

    $nextCategory = $categories->where('id', '>', $currentCategory->id)->first();
    
    $totalDurasi = $currentCategory->durasi;

    $totalSoal = $soals->count();

    return view('tryout.soal', compact(
        'tryout', 
        'soals', 
        'totalDurasi', 
        'currentCategory', 
        'nextCategory', 
        'categories',
        'totalSoal'
    ));
}

    public function jeda($id, $next_category_id)
    {
        $tryout = AdminTryout::findOrFail($id);
        $categories = DB::table('tryout_categories')->where('admin_tryout_id', $id)->orderBy('id', 'asc')->get();
        return view('tryout.jeda', compact('tryout', 'categories', 'next_category_id'));
    }

    public function hasil($id) 
    {
        $tryout = AdminTryout::findOrFail($id);
        $userId = Auth::id();
        $categoryIds = DB::table('tryout_categories')->where('admin_tryout_id', $id)->pluck('id');
        $allSoalIds = DB::table('soal_tryouts')->whereIn('category_id', $categoryIds)->pluck('id');
        $userAnswers = DB::table('soal_tryouts')
                        ->leftJoin('tryout_jawaban_peserta', function($join) use ($userId) {
                            $join->on('soal_tryouts.id', '=', 'tryout_jawaban_peserta.soal_id')
                                 ->where('tryout_jawaban_peserta.user_id', '=', $userId);
                        })
                        ->whereIn('soal_tryouts.category_id', $categoryIds)
                        ->select('soal_tryouts.*', 'tryout_jawaban_peserta.pilihan_user', 'tryout_jawaban_peserta.is_correct')
                        ->get();
        $totalSoal = $userAnswers->count();
        $benar = $userAnswers->where('is_correct', true)->count();
        $salah = $userAnswers->where('is_correct', false)->whereNotNull('pilihan_user')->count();
        $kosong = $totalSoal - ($benar + $salah);
        $skorTotal = ($totalSoal > 0) ? round(($benar / $totalSoal) * 1000) : 0;
        $akurasi = ($totalSoal > 0) ? round(($benar / $totalSoal) * 100) : 0;
        $categories = DB::table('tryout_categories')->where('admin_tryout_id', $id)->get()->map(function ($cat) use ($userId) {
            $sIds = DB::table('soal_tryouts')->where('category_id', $cat->id)->pluck('id');
            $bCount = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $sIds)->where('user_id', $userId)->where('is_correct', true)->count();
            $cat->skor = ($sIds->count() > 0) ? round(($bCount / $sIds->count()) * 1000) : 0;
            return $cat;
        });
        $participantIds = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $allSoalIds)->pluck('user_id')->unique()->toArray();
        if (!in_array($userId, $participantIds)) { $participantIds[] = $userId; }
        $rankingsFull = collect($participantIds)->map(function($pId) use ($allSoalIds, $totalSoal) {
            $uBenar = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $allSoalIds)->where('user_id', $pId)->where('is_correct', 1)->count();
            return (object)['user_id' => $pId, 'user' => DB::table('users')->where('id', $pId)->first(), 'skor_total' => ($totalSoal > 0) ? round(($uBenar / $totalSoal) * 1000) : 0];
        })->sortByDesc('skor_total')->values();
        $userRankIndex = $rankingsFull->search(fn($r) => $r->user_id == $userId);
        $userRankNumber = ($userRankIndex !== false) ? $userRankIndex + 1 : 1;
        $rankings = $rankingsFull; 

        $xpService = new XpService();
$xpService->addXp(Auth::user(), 'tryout', 50);

        return view('tryout.hasil', compact('tryout', 'categories', 'userAnswers', 'benar', 'salah', 'kosong', 'akurasi', 'skorTotal', 'rankings', 'userRankNumber'));
    }

    public function ranking($id) 
    {
        set_time_limit(120);
        $tryout = AdminTryout::findOrFail($id);
        $userId = Auth::id();
        $categoryIds = DB::table('tryout_categories')->where('admin_tryout_id', $id)->pluck('id');
        $allSoalIds = DB::table('soal_tryouts')->whereIn('category_id', $categoryIds)->pluck('id');
        $totalSoalCount = $allSoalIds->count();
        $allAnswers = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $allSoalIds)->get();
        $participantIds = $allAnswers->pluck('user_id')->unique()->toArray();
        if (!in_array($userId, $participantIds)) { $participantIds[] = $userId; }
        $users = DB::table('users')->whereIn('id', $participantIds)->get()->keyBy('id');
        $rankings = collect($participantIds)->map(function($pId) use ($allAnswers, $users, $totalSoalCount) {
            $userAnswers = $allAnswers->where('user_id', $pId);
            $uBenar = $userAnswers->where('is_correct', 1)->count();
            $lastDate = $userAnswers->max('created_at') ?? now()->toDateTimeString();
            return (object)['user_id' => (int)$pId, 'user' => $users->get($pId), 'skor_total' => ($totalSoalCount > 0) ? round(($uBenar / $totalSoalCount) * 1000) : 0, 'created_at' => \Carbon\Carbon::parse($lastDate)];
        })->sortByDesc('skor_total')->values();
        $userRankIndex = $rankings->search(fn($item) => (int)$item->user_id === (int)$userId);
        $userRankNumber = ($userRankIndex !== false) ? $userRankIndex + 1 : 1;
        $userRank = $rankings->first(fn($item) => (int)$item->user_id === (int)$userId);
        return view('tryout.ranking', compact('tryout', 'rankings', 'userRank', 'userRankNumber'));
    }

    public function simpanJawaban(Request $request, $id)
    {
        $userId = Auth::id();
        $jawabanData = $request->input('jawaban'); 
        if (!$jawabanData) { return response()->json(['status' => 'error', 'message' => 'Tidak ada data jawaban']); }
        foreach ($jawabanData as $soalId => $pilihan) {
            $soal = DB::table('soal_tryouts')->where('id', $soalId)->first();
            if ($soal) {
                $isCorrect = (strtoupper($soal->jawaban_benar ?? '') == strtoupper($pilihan));
                DB::table('tryout_jawaban_peserta')->updateOrInsert(
                    ['user_id' => $userId, 'soal_id' => $soalId],
                    ['pilihan_user' => $pilihan, 'is_correct' => $isCorrect, 'updated_at' => now(), 'created_at' => now()]
                );
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function generateSertifikat($id)
    {
        $tryout = AdminTryout::findOrFail($id);
        $user = Auth::user();
        $userId = $user->id;
        $categories = DB::table('tryout_categories')->where('admin_tryout_id', $id)->get()->map(function ($cat) use ($userId) {
            $sIds = DB::table('soal_tryouts')->where('category_id', $cat->id)->pluck('id');
            $bCount = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $sIds)->where('user_id', $userId)->where('is_correct', true)->count();
            $cat->skor = ($sIds->count() > 0) ? round(($bCount / $sIds->count()) * 1000) : 0;
            return $cat;
        });
        $allSoalIds = DB::table('soal_tryouts')->whereIn('category_id', $categories->pluck('id'))->pluck('id');
        $totalSoal = $allSoalIds->count();
        $totalBenar = DB::table('tryout_jawaban_peserta')->whereIn('soal_id', $allSoalIds)->where('user_id', $userId)->where('is_correct', true)->count();
        $skorTotal = ($totalSoal > 0) ? round(($totalBenar / $totalSoal) * 1000) : 0;
        $data = ['tryout' => $tryout, 'user' => $user, 'categories' => $categories, 'skor_total' => $skorTotal, 'tanggal' => now()->translatedFormat('d F Y')];
        $pdf = Pdf::loadView('tryout.sertifikat_pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Sertifikat_' . $user->name . '.pdf');
    }
}