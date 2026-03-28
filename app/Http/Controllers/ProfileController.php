<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\XpService;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(XpService $xpService)
{
    $user = Auth::user();
     $xpService->checkStreakExpired($user);

    $xpProgress = $xpService->getXpProgress($user);

    // ========================
    // TRYOUT (pakai skor_total dari rank)
    // ========================
    $tryouts = DB::table('tryout_jawaban_peserta')
    ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
    ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
->join('admin_tryouts', 'tryout_categories.admin_tryout_id', '=', 'admin_tryouts.id')
    ->where('tryout_jawaban_peserta.user_id', $user->id)
    ->select(
        'tryout_categories.admin_tryout_id as tryout_id',
'admin_tryouts.nama_tryout as nama_tryout',
        DB::raw('COUNT(*) as total_soal'),
        DB::raw('SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as benar'),
        DB::raw('MAX(tryout_jawaban_peserta.created_at) as tanggal')
    )
    ->groupBy('tryout_categories.admin_tryout_id', 'admin_tryouts.nama_tryout')
    ->orderByDesc('tanggal')
    ->take(5)
    ->get()
    ->map(function ($item) {
        $item->skor_total = ($item->total_soal > 0)
            ? round(($item->benar / $item->total_soal) * 1000)
            : 0;
        return $item;
    });

    // ========================
    // KUIS
    // skor = benar * 5
    // ========================
    $kuis = DB::table('hasil_kuis')
    ->join('kuis', 'hasil_kuis.kuis_id', '=', 'kuis.id')
    ->where('hasil_kuis.user_id', $user->id)
    ->select(
        'hasil_kuis.*',
        'kuis.kategori as kategori'
    )
    ->latest()
    ->take(5)
    ->get()
    ->map(function ($item) {
        $item->skor_hitung = $item->benar * 5;
        return $item;
    });

    // ========================
    // LATIHAN
    // skor = benar * 5
    // ========================
    $latihan = DB::table('hasil_latihans')
    ->join('latihans', 'hasil_latihans.latihan_id', '=', 'latihans.id')
    ->where('hasil_latihans.user_id', $user->id)
    ->select(
        'hasil_latihans.*',
        'latihans.subtes as kategori'
    )
    ->latest()
    ->take(5)
    ->get()
    ->map(function ($item) {
        $item->skor_hitung = $item->benar * 5;
        return $item;
    });

    // ========================
    // GABUNG SEMUA AKTIVITAS
    // ========================
    $activities = collect([]);

    foreach ($tryouts as $t) {
    $activities->push([
        'type' => 'tryout',
        'title' => 'Tryout - ' . $t->nama_tryout,
        'skor' => $t->skor_total ?? 0,
        'tanggal' => $t->tanggal,
    ]);
}

    foreach ($kuis as $k) {
    $activities->push([
        'type' => 'kuis',
        'title' => 'Kuis - ' . ($k->kategori ?? 'Umum'),
        'skor' => $k->skor_hitung,
        'tanggal' => $k->created_at,
    ]);
}

    foreach ($latihan as $l) {
    $activities->push([
        'type' => 'latihan',
        'title' => 'Latihan - ' . ($l->kategori ?? 'Umum'),
        'skor' => $l->skor_hitung,
        'tanggal' => $l->created_at,
    ]);
}


// DATA TO
$tryoutStats = DB::table('tryout_jawaban_peserta')
    ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
    ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
    ->join('admin_tryouts', 'tryout_categories.admin_tryout_id', '=', 'admin_tryouts.id')
    ->where('tryout_jawaban_peserta.user_id', $user->id)
    ->select(
        'tryout_categories.admin_tryout_id',
        DB::raw('COUNT(*) as total_soal'),
        DB::raw('SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) as benar'),
        DB::raw('MAX(tryout_jawaban_peserta.created_at) as tanggal')
    )
    ->groupBy('tryout_categories.admin_tryout_id')
    ->get()
    ->map(function ($item) {
        $item->skor = ($item->total_soal > 0)
            ? round(($item->benar / $item->total_soal) * 1000)
            : 0;
        return $item;
    });

    $tryoutTerbaru = $tryoutStats->sortByDesc('tanggal')->first();
$tryoutTerbesar = $tryoutStats->sortByDesc('skor')->first();

    // SORT TERBARU
    $activities = $activities->sortByDesc('tanggal')->take(6);

    return view('profile.index', compact(
    'user',
    'activities',
    'tryoutTerbaru',
    'tryoutTerbesar',
    'xpProgress'
));
}

    
    public function edit()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    try {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
        'name'  => 'required|string|max:255',
        'no_hp' => 'required|numeric|digits_between:11,100',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

        'password' => [
            'nullable',
            'required_with:password_confirmation', 
            'min:6',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/',
        ],

        'password_confirmation' => [
            'nullable',
            'required_with:password', 
            'same:password'
        ],

    ], [
        'password.required_with' => 'Password wajib diisi jika konfirmasi diisi.',
        'password_confirmation.required_with' => 'Konfirmasi password wajib diisi jika password diisi.',
        'password_confirmation.same' => 'Konfirmasi password tidak cocok.',
        'password.regex' => 'Password harus mengandung angka dan simbol.',
    ]);

        // Update data
        $user->name = $request->name;
        $user->no_hp = $request->no_hp;

        // Update password (optional)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update photo
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('storage/' . $user->photo))) {
                unlink(public_path('storage/' . $user->photo));
            }

            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');

    } catch (\Exception $e) {
       
        return back()->with('error', 'Terjadi kesalahan, coba lagi!');
    }
}

public function log()
{
    $user = Auth::user();
    $tab = request('tab', 'all'); // default semua

    // ========================
    // TRYOUT
    // ========================
    $tryouts = DB::table('tryout_jawaban_peserta')
        ->join('soal_tryouts', 'tryout_jawaban_peserta.soal_id', '=', 'soal_tryouts.id')
        ->join('tryout_categories', 'soal_tryouts.category_id', '=', 'tryout_categories.id')
        ->join('admin_tryouts', 'tryout_categories.admin_tryout_id', '=', 'admin_tryouts.id')
        ->where('tryout_jawaban_peserta.user_id', $user->id)
        ->select(
            'admin_tryouts.nama_tryout as title',
            DB::raw("'tryout' as type"),
            DB::raw('ROUND(SUM(CASE WHEN is_correct = 1 THEN 1 ELSE 0 END) / COUNT(*) * 1000) as skor'),
            DB::raw('MAX(tryout_jawaban_peserta.created_at) as tanggal')
        )
        ->groupBy('admin_tryouts.nama_tryout');

    // ========================
    // KUIS
    // ========================
    $kuis = DB::table('hasil_kuis')
    ->join('kuis', 'hasil_kuis.kuis_id', '=', 'kuis.id')
    ->where('hasil_kuis.user_id', $user->id)
    ->select(
        DB::raw("CONCAT('Kuis - ', kuis.kategori) as title"),
        DB::raw("'kuis' as type"),
        DB::raw('(hasil_kuis.benar * 5) as skor'),
        'hasil_kuis.created_at as tanggal'
    );

    // ========================
    // LATIHAN
    // ========================
    $latihan = DB::table('hasil_latihans')
    ->join('latihans', 'hasil_latihans.latihan_id', '=', 'latihans.id')
    ->where('hasil_latihans.user_id', $user->id)
    ->select(
        DB::raw("CONCAT('Latihan - ', latihans.subtes) as title"),
        DB::raw("'latihan' as type"),
        DB::raw('(hasil_latihans.benar * 5) as skor'),
        'hasil_latihans.created_at as tanggal'
    );

    // ========================
    // UNION + PAGINATION
    // ========================
    $activities = $tryouts
        ->unionAll($kuis)
        ->unionAll($latihan);

    $query = DB::query()
    ->fromSub($activities, 'activities');

// FILTER BERDASARKAN TAB 🔥
if ($tab === 'kuis') {
    $query->where('type', 'kuis');
} elseif ($tab === 'latihan') {
    $query->where('type', 'latihan');
} elseif ($tab === 'tryout') {
    $query->where('type', 'tryout');
}

// PAGINATION + QUERY STRING
$activities = $query
    ->orderByDesc('tanggal')
    ->paginate(12)
    ->withQueryString(); // WAJIB 🔥

    return view('profile.log', compact('activities'));
}

}
