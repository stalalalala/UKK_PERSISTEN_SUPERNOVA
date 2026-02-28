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
        Route::resource('monitoringLaporan', HalamanMonitoringLaporanController::class)->names('laporan');

        Route::get('videoPembelajaran/history', [AdminVideoController::class, 'history'])->name('videoPembelajaran.history');
        Route::post('videoPembelajaran/{id}/restore', [AdminVideoController::class, 'restore'])->name('videoPembelajaran.restore');
        Route::delete('videoPembelajaran/{id}/force-delete', [AdminVideoController::class, 'forceDelete'])->name('videoPembelajaran.force-delete');
        Route::post('videoPembelajaran/import',
            [AdminVideoController::class, 'import'])->name('videoPembelajaran.import');

        Route::resource('videoPembelajaran', AdminVideoController::class);

        // Peluang PTN
        Route::resource('peluangPtn', HalamanPeluangPtnController::class)->names('peluang');
        Route::post('/peluangPtn/store', [HalamanPeluangPtnController::class, 'store'])->name('peluangPtn.store');
        Route::delete('/peluangPtn/{id}', [HalamanPeluangPtnController::class, 'destroy'])->name('peluangPtn.destroy');

        // TRYOUT
        Route::resource('tryout', AdminTryoutController::class);
        Route::patch('tryout/{id}/toggle', [AdminTryoutController::class, 'toggleStatus'])->name('tryout.toggle');

        // minat bakat
        Route::get('minat-bakat/manajemen', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'manajemenSoal'])
    ->name('minatbakat.manajemen');

        Route::post('minat-bakat/soal', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'storeSoal'])
            ->name('minatbakat.soal.store');

        Route::post('minat-bakat/soal/restore', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'restoreSoal'])
            ->name('minatbakat.soal.restore');

        Route::delete('minat-bakat/soal/{id}', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'destroySoal'])
            ->name('minatbakat.soal.destroy');
        
        Route::get('minat-bakat/export', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'exportPartisipan'])
        ->name('minatbakat.export');

        Route::post('minat-bakat/reset', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'resetPartisipan'])
        ->name('minatbakat.reset');

        Route::get('minat-bakat/pdf/{id}', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'generatePdf'])
    ->name('minatbakat.pdf');

        Route::post('minat-bakat/soal/import-bulk', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'importSoalBulk'])
    ->name('minatbakat.soal.importBulk');

        Route::resource('minatBakat', AdminMinatBakatController::class)->names([
            'index'   => 'minatbakat.index',
            'store'   => 'minatbakat.kategori.store',
            'update'  => 'minatbakat.kategori.update',
            'destroy' => 'minatbakat.kategori.destroy',
        ]);
        
        // Kuis Fundamental
        Route::get('/kuis', [AdminKuisController::class, 'index'])->name('kuis.index');
        Route::get('/kuis/create', [AdminKuisController::class, 'create'])->name('kuis.create');
        Route::post('/kuis/store', [AdminKuisController::class, 'store'])->name('kuis.store'); 
        Route::get('/kuis/{id}/edit', [AdminKuisController::class, 'edit'])->name('kuis.edit');
        Route::put('/kuis/{id}', [AdminKuisController::class, 'update'])->name('kuis.update'); 
        Route::delete('/kuis/{id}', [AdminKuisController::class, 'destroy'])->name('kuis.destroy'); 
        Route::post('/kuis/{id}/toggle', [AdminKuisController::class, 'toggle'])->name('kuis.toggle'); 
        Route::post('/kuis/{id}/restore', [AdminKuisController::class, 'restore'])->name('kuis.restore'); 
        Route::delete('/kuis/force-delete/{id}', [AdminKuisController::class, 'forceDelete'])->name('kuis.forceDelete'); 
         

        // Latihan
        // Latihan Soal
         Route::get('/latihan', [AdminLatihanController::class, 'index'])->name('latihan.index');
         Route::get('/latihan/create', [AdminLatihanController::class, 'create'])->name('latihan.create');
         Route::post('/latihan/store', [AdminLatihanController::class, 'store'])->name('latihan.store'); 
         Route::get('/latihan/{id}/edit', [AdminLatihanController::class, 'edit'])->name('latihan.edit');
         Route::put('/latihan/{id}', [AdminLatihanController::class, 'update'])->name('latihan.update'); 
         Route::delete('/latihan/{id}', [AdminLatihanController::class, 'destroy'])->name('latihan.destroy'); 
         Route::post('/latihan/{id}/toggle', [AdminLatihanController::class, 'toggle'])->name('latihan.toggle'); 
         Route::post('/latihan/{id}/restore', [AdminLatihanController::class, 'restore'])->name('latihan.restore'); 
         Route::delete('/latihan/force-delete/{id}', [AdminLatihanController::class, 'forceDelete'])->name('latihan.forceDelete');

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
        Route::get('/intruksi/{id}', [TryoutController::class, 'intruksi'])->name('intruksi');
        // Tambahkan {category_id?} agar opsional
        Route::get('/soal/{id}/{category_id?}', [TryoutController::class, 'soal'])->name('soal');
        Route::post('/simpan-jawaban/{id}', [TryoutController::class, 'simpanJawaban'])->name('simpan');
        
        // Tambahkan {next_category_id} agar sinkron dengan Controller
        Route::get('/jeda/{id}/{next_category_id}', [TryoutController::class, 'jeda'])->name('jeda');
        
        Route::get('/hasil/{id}', [TryoutController::class, 'hasil'])->name('hasil');
        Route::get('/ranking/{id}', [TryoutController::class, 'ranking'])->name('ranking');
        Route::get('/sertifikat/{id}', [TryoutController::class, 'generateSertifikat'])->name('sertifikat');
    });
        
        // Latihan

        Route::prefix('latihan')->name('latihan.')->group(function () {
    Route::get('/', [LatihanController::class, 'index'])->name('index');
    Route::get('/intruksi/{id}', [LatihanController::class, 'intruksi'])->name('intruksi');
    Route::get('/soal/{id}', [LatihanController::class, 'soal'])->name('soal');
    Route::post('/submit/{id}', [LatihanController::class, 'submit'])->name('submit');
    Route::get('/hasil/{id}', [LatihanController::class, 'hasil'])->name('hasil');
});


        /* =======================
           KUIS PESERTA
        ======================= */
        Route::prefix('kuis')->name('kuis.')->group(function () {
        Route::get('/', [KuisController::class, 'index'])->name('index');
        Route::get('/intruksi/{id}', [KuisController::class, 'intruksi'])->name('intruksi');
        Route::get('/soal/{id}', [SoalKuisController::class, 'index'])->name('soal');
        Route::post('/submit/{id}', [KuisController::class, 'submit'])->name('submit');
        Route::get('/hasil/{id}', [KuisController::class, 'hasil'])->name('hasil');
      });

        // Minat Bakat
        Route::get('minatbakat/hasil', [MinatBakatController::class, 'hasil'])->name('minatbakat.hasil');
        Route::get('minatbakat/intruksi', [MinatBakatController::class, 'intruksi'])->name('minatbakat.intruksi');

        Route::resource('minatbakat', MinatBakatController::class)->names([
            'index' => 'minatbakat.soal',
        ]);

        Route::get('/slime', function () { return view('slime'); });
        Route::get('/slime_login', function () { return view('slime_login'); });
    });

});
