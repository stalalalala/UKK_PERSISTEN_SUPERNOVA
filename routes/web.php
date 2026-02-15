<?php

use App\Http\Controllers\KuisController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\StreakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\admin\HalamanStreakController;
use App\Http\Controllers\admin\HalamanPeluangPtnController;
use App\Http\Controllers\admin\HalamanMonitoringLaporanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HalamanStreakController as ControllersHalamanStreakController;
use App\Http\Controllers\HasilKuisController;
use App\Http\Controllers\HasilLatihanController;
use App\Http\Controllers\HasilTryoutController;
use App\Http\Controllers\IntruksiKuisController;
use App\Http\Controllers\IntruksiLatihanController;
use App\Http\Controllers\IntruksiMinatBakatController;
use App\Http\Controllers\IntruksiTryoutController;
use App\Http\Controllers\JedaTryoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\SoalLatihanController;
use App\Http\Controllers\SoalTryoutController;

Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// profile
Route::get('/profile/edit', function () {
    return view('profile.edit');
});

// streak
Route::get('/streak', [StreakController::class, 'index'])->name('streak.index');

// tryout

Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout.index');

Route::get('/tryout/intruksi', [IntruksiTryoutController::class, 'index'])->name('tryout.intruksi');

Route::get('/tryout/jeda', [JedaTryoutController::class, 'index'])->name('tryout.jeda');

Route::get('/tryout/ranking', [RankingController::class, 'index'])->name('tryout.ranking');

Route::get('/tryout/soal', [SoalTryoutController::class, 'index'])->name('tryout.soal');

Route::get('/tryout/hasil', [HasilTryoutController::class, 'index'])->name('tryout.hasil');

//latihan

Route::get('/latihan', [LatihanController::class, 'index'])->name('latihan.index');

Route::get('/latihan/soal', [SoalLatihanController::class, 'index'])->name('latihan.soal');

Route::get('/latihan/hasil', [HasilLatihanController::class, 'index'])->name('latihan.hasil');

Route::get('/latihan/intruksi', [IntruksiLatihanController::class, 'index'])->name('latihan.intruksi');

// video

Route::get('/video', [VideoController::class, 'index'])->name('video.index');

// kuis

Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');

Route::get('/kuis/soal', [SoalKuisController::class, 'index'])->name('kuis.soal');

Route::get('/kuis/hasil', [HasilKuisController::class, 'index'])->name('kuis.hasil');

Route::get('/kuis/intruksi', [IntruksiKuisController::class, 'index'])->name('kuis.intruksi');



// slime

Route::get('/slime', function () {
    return view('slime');
});

Route::get('/slime_login', function () {
    return view('slime_login');
});

// masuk/daftar

Route::get('/masuk', function () {
    return view('Auth/masuk');
});

Route::get('/daftar', function () {
    return view('Auth/daftar');
});

// minat bakat

Route::get('/minatbakat', [MinatBakatController::class, 'index'])->name('minatbakat.soal');

Route::get('/minatbakat/hasil', [MinatBakatController::class, 'index'])->name('minatbakat.hasil');

Route::get('/minatbakat/intruksi', [IntruksiMinatBakatController::class, 'index'])->name('minatbakat.intruksi');











// admin //
// dashboard
Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});


Route::get('/admin/streak', [HalamanStreakController::class, 'index'])->name('admin.streak.index');
Route::get('/admin/peluangPtn', [HalamanPeluangPtnController::class, 'index'])->name('admin.peluang.index');
Route::get('/admin/monitoringLaporan', [HalamanMonitoringLaporanController::class, 'index'])->name('admin.laporan.index');

Route::get('/admin/user/index', function () {
    return view('admin/user/index');
});


    
Route::get('/admin/video/index', function () {
        return view('admin/video/index');
});
        
// kuis

Route::get('/admin/kuis/index', function () {
    return view('admin/kuis/index');
});

Route::get('/admin/kuis/create', function () {
    return view('admin/kuis/create');
});

Route::get('/admin/kuis/edit', function () {
    return view('admin/kuis/edit');
});


// tryout
Route::get('/admin/tryout/index', function () {
    return view('admin/tryout/index');
});

Route::get('/admin/tryout/create', function () {
    return view('admin/tryout/create');
});

Route::get('/admin/tryout/edit', function () {
    return view('admin/tryout/edit');
});

// minat bakat
Route::get('/admin/minatbakat/index', function () {
    return view('admin/minatbakat/index');
});

Route::get('/admin/minatbakat/kategori', function () {
    return view('admin/minatbakat/kategori');
});

Route::get('/admin/minatbakat/editor', function () {
    return view('admin/minatbakat/editor');
});

Route::get('/admin/minatbakat/partisipasi', function () {
    return view('admin/minatbakat/partisipasi');
});

Route::get('/admin/video/index', function () {
    return view('admin/video/index');
});

Route::get('/admin/latihan_soal/index', function () {
    return view('admin/latihan_soal/index');
});

Route::get('/admin/latihan_soal/tambah', function () {
    return view('admin/latihan_soal/tambah');
});

Route::get('/admin/latihan_soal/history', function () {
    return view('admin/latihan_soal/history');
});

Route::get('/admin/latihan_soal/edit', function () {
    return view('admin/latihan_soal/edit');
});