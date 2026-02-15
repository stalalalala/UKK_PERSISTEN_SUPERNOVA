<?php

use App\Http\Controllers\admin\AdminKuisController;
use App\Http\Controllers\admin\AdminLatihanController;
use App\Http\Controllers\admin\AdminMinatBakatController;
use App\Http\Controllers\admin\AdminTryoutController;
use App\Http\Controllers\admin\AdminVideoController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\StreakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\admin\DashboardController;
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
use App\Models\admin\AdminMinatBakat;

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


Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard biasanya hanya index, kita bisa batasi pakai only()
    Route::resource('dashboard', DashboardController::class)->only(['index']);

    Route::resource('user', User::class);
    Route::resource('streak', HalamanStreakController::class);
    Route::resource('peluangPtn', HalamanPeluangPtnController::class)->names('peluang');
    Route::resource('monitoringLaporan', HalamanMonitoringLaporanController::class)->names('laporan');
    Route::resource('tryout', AdminTryoutController::class);
    Route::resource('kuis', AdminKuisController::class);
    Route::resource('latihan', AdminLatihanController::class);
    Route::resource('videoPembelajaran', AdminVideoController::class);
    Route::resource('minatBakat', AdminMinatBakatController::class);
});
