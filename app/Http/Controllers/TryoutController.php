<?php

namespace App\Http\Controllers;

use App\Models\AdminTryout;
use App\Models\SoalTryout;
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

        // 1. Ambil semua tryout
        $tryouts = AdminTryout::orderBy('id', 'asc')->get();

        // 2. Ambil ID tryout yang sudah pernah dikerjakan oleh user ini
        // Kita cek lewat tabel tryout_jawaban_peserta
        $userResults = DB::table('tryout_jawaban_peserta')
            ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
            ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
            ->where('tryout_jawaban_peserta.user_id', $userId)
            ->select('tryout_categories.admin_tryout_id as tryout_id')
            ->distinct()
            ->get();

        // 3. Tentukan status ketersediaan (is_available)
        $tryouts->transform(function ($item) use ($now, $userResults) {
            $isWithinDate = ($now >= $item->tanggal && $now <= $item->tanggal_akhir);
            
            // Cek apakah user sudah mengerjakan TO ini
            $sudahDikerjakan = $userResults->contains('tryout_id', $item->id);

            // TO tersedia JIKA: Aktif AND Dalam rentang tanggal AND Belum pernah dikerjakan
            $item->is_available = ($item->is_active && $isWithinDate && !$sudahDikerjakan);
            
            return $item;
        });

        // Kirim $userResults ke view agar index.blade.php tidak error lagi
        return view('tryout.index', compact('tryouts', 'userResults'));
    }

    /**
     * Menampilkan halaman instruksi sebelum mulai.
     */
    public function intruksi($id) 
    {
        $tryout = AdminTryout::findOrFail($id);
        
        // Proteksi: Jika sudah pernah mengerjakan, lempar ke halaman hasil
        $userId = Auth::id();
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

        return view('tryout.intruksi', compact('tryout', 'firstCategory'));
    }

    // ... (Fungsi soal, jeda, hasil, ranking, simpanJawaban, dan generateSertifikat tetap sama seperti kode Anda)
    // Saya tidak mengubahnya agar logika pengerjaan Anda tidak rusak.
    
    public function soal($id, $category_id = null) 
    {
        $tryout = AdminTryout::findOrFail($id);
        $categories = DB::table('tryout_categories')->where('admin_tryout_id', $id)->orderBy('id', 'asc')->get();
        if (!$category_id) { $currentCategory = $categories->first(); } 
        else { $currentCategory = $categories->where('id', $category_id)->first(); }
        $nextCategory = $categories->where('id', '>', $currentCategory->id)->first();
        $soals = SoalTryout::where('category_id', $currentCategory->id)->get();
        $totalDurasi = $currentCategory->durasi;
        return view('tryout.soal', compact('tryout', 'soals', 'totalDurasi', 'currentCategory', 'nextCategory', 'categories'));
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