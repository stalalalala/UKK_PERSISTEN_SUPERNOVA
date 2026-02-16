<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/* ===============================
   ADMIN CONTROLLERS
================================ */
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AdminKuisController;
use App\Http\Controllers\admin\AdminLatihanController;
use App\Http\Controllers\admin\AdminTryoutController;
use App\Http\Controllers\admin\AdminVideoController;
use App\Http\Controllers\admin\AdminMinatBakatController;

use App\Http\Controllers\admin\HalamanStreakController;
use App\Http\Controllers\admin\HalamanPeluangPtnController;
use App\Http\Controllers\admin\HalamanMonitoringLaporanController;

/* ===============================
   PESERTA CONTROLLERS
================================ */
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StreakController;
use App\Http\Controllers\VideoController;

use App\Http\Controllers\TryoutController;
use App\Http\Controllers\IntruksiTryoutController;
use App\Http\Controllers\JedaTryoutController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SoalTryoutController;
use App\Http\Controllers\HasilTryoutController;

use App\Http\Controllers\LatihanController;
use App\Http\Controllers\IntruksiLatihanController;
use App\Http\Controllers\SoalLatihanController;
use App\Http\Controllers\HasilLatihanController;

use App\Http\Controllers\KuisController;
use App\Http\Controllers\IntruksiKuisController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\HasilKuisController;

use App\Http\Controllers\MinatBakatController;

/* =========================================================
   1. ROUTES GUEST (Belum Login)
========================================================= */
Route::middleware('guest')->group(function () {

    Route::get('/masuk', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/masuk', [LoginController::class, 'login']);

    Route::get('/daftar', function () {
        return view('Auth.daftar');
    })->name('register');

});


/* =========================================================
   2. ROUTES AUTH (Sudah Login)
========================================================= */
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    /* =====================================================
       3. ROLE ADMIN ROUTES
    ===================================================== */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');

        /* User Management */
        Route::resource('user', UserController::class);

        /* Halaman Admin Tambahan */
        Route::resource('streak', HalamanStreakController::class);
        Route::resource('peluangPtn', HalamanPeluangPtnController::class)->names('peluang');
        Route::resource('monitoringLaporan', HalamanMonitoringLaporanController::class)->names('laporan');

        /* Manajemen Fitur UTBK */
        
        Route::resource('tryout', AdminTryoutController::class);
        Route::resource('latihan', AdminLatihanController::class);
        Route::resource('videoPembelajaran', AdminVideoController::class);

        // Kuis Fundamental 
        Route::get('/kuis', [AdminKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/create', [AdminKuisController::class, 'create'])->name('kuis.create');
        Route::post('/kuis/store', [AdminKuisController::class, 'store'])->name('kuis.store');
        Route::get('/kuis/{id}/edit', [AdminKuisController::class, 'edit'])->name('kuis.edit');
        Route::put('/kuis/{id}', [AdminKuisController::class, 'update'])->name('kuis.update');
        Route::delete('/kuis/{id}', [AdminKuisController::class, 'destroy'])->name('kuis.destroy');
        Route::post('/kuis/{id}/toggle', [AdminKuisController::class, 'toggle'])->name('kuis.toggle');
        Route::post('/kuis/{id}/restore', [AdminKuisController::class, 'restore'])->name('kuis.restore');


        /* Minat Bakat */
        Route::resource('minatBakat', AdminMinatBakatController::class);

        /* Extra Menu Minat Bakat */
        Route::get('minatbakat/editor', [AdminMinatBakatController::class, 'editor'])->name('minatbakat.editor');
        Route::get('minatbakat/kategori', [AdminMinatBakatController::class, 'kategori'])->name('minatbakat.kategori');
        Route::get('minatbakat/partisipasi', [AdminMinatBakatController::class, 'partisipasi'])->name('minatbakat.partisipasi');

    });


    /* =====================================================
       4. ROLE PESERTA ROUTES
    ===================================================== */
    Route::middleware('role:peserta')->group(function () {

        /* =======================
           Beranda Peserta
        ======================= */
        Route::get('/', [BerandaController::class, 'index']) ->name('beranda');


        /* =======================
           Profile Peserta
        ======================= */
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::view('/profile/edit', 'profile.edit')->name('profile.edit');


        /* =======================
           Streak & Video
        ======================= */
        Route::get('/streak', [StreakController::class, 'index'])->name('streak.index');
        Route::get('/video', [VideoController::class, 'index'])->name('video.index');


        /* =======================
           TRYOUT PESERTA
        ======================= */
        Route::prefix('tryout')->name('tryout.')->group(function () {
            Route::get('/', [TryoutController::class, 'index'])->name('index');
            Route::get('/intruksi', [IntruksiTryoutController::class, 'index'])->name('intruksi');
            Route::get('/jeda', [JedaTryoutController::class, 'index'])->name('jeda');
            Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
            Route::get('/soal', [SoalTryoutController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilTryoutController::class, 'index'])->name('hasil');
        });


        /* =======================
           LATIHAN PESERTA
        ======================= */
        Route::prefix('latihan')->name('latihan.')->group(function () {
            Route::get('/', [LatihanController::class, 'index'])->name('index');
            Route::get('/intruksi', [IntruksiLatihanController::class, 'index'])->name('intruksi');
            Route::get('/soal', [SoalLatihanController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilLatihanController::class, 'index'])->name('hasil');
        });


        /* =======================
           KUIS PESERTA
        ======================= */
        Route::prefix('kuis')->name('kuis.')->group(function () {
            Route::get('/', [KuisController::class, 'index'])->name('index');
            Route::get('/intruksi', [IntruksiKuisController::class, 'index'])->name('intruksi');
            Route::get('/soal', [SoalKuisController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilKuisController::class, 'index'])->name('hasil');
        });


        /* =======================
           MINAT BAKAT PESERTA
        ======================= */
        Route::get('minatbakat/intruksi', [MinatBakatController::class, 'intruksi'])->name('minatbakat.intruksi');
        Route::get('minatbakat/hasil', [MinatBakatController::class, 'hasil'])->name('minatbakat.hasil');
        Route::resource('minatbakat', MinatBakatController::class)->only(['index']);



        /* =======================
           Slime Pages
        ======================= */
        Route::view('/slime', 'slime');
        Route::view('/slime_login', 'slime_login');

    });

});
