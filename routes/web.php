<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

/* ===============================
   ADMIN CONTROLLERS
================================ */
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordForgotController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Auth;

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

use App\Http\Controllers\KuisController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\SoalKuisController;

// ==============================
// Guest Routes (belum login)
// ==============================

Route::middleware('guest')->group(function(){
    Route::get('/masuk', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/masuk', [LoginController::class, 'login']);

    Route::get('/daftar', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/daftar', [LoginController::class, 'register']);

    Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])
        ->name('login.google');

    Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback'])
        ->name('login.google.callback');
});

Route::get('/lupa-password', [PasswordForgotController::class, 'showForm'])
    ->name('password.request');

Route::post('/lupa-password', [PasswordForgotController::class, 'sendLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');


Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        Route::resource('dashboard', DashboardController::class)->only(['index']);
         Route::get('user/history', [UserController::class, 'history'])
            ->name('user.history');

        Route::post('user/{id}/restore', [UserController::class, 'restore'])
            ->name('user.restore');

       Route::delete('user/{id}/force-delete', [UserController::class, 'forceDelete'])
    ->name('user.forceDelete');

            Route::resource('user', UserController::class);

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
    ->name('minatBakat.manajemen');

        Route::post('minat-bakat/soal', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'storeSoal'])
            ->name('minatBBakat.soal.store');

        Route::post('minat-bakat/soal/restore', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'restoreSoal'])
            ->name('minatBakat.soal.restore');

        Route::delete('minat-bakat/soal/{id}', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'destroySoal'])
            ->name('minatBakat.soal.destroy');
        
        Route::get('minat-bakat/export', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'exportPartisipan'])
        ->name('minatBakat.export');

        Route::post('minat-bakat/reset', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'resetPartisipan'])
        ->name('minatBakat.reset');

        Route::get('minat-bakat/pdf/{id}', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'generatePdf'])
    ->name('minatBakat.pdf');

        Route::post('minat-bakat/soal/import-bulk', [App\Http\Controllers\admin\AdminMinatBakatController::class, 'importSoalBulk'])
    ->name('minatBakat.soal.importBulk');

    Route::resource('minatBakat', AdminMinatBakatController::class)->names([
            'index'   => 'minatBakat.index',
            'store'   => 'minatBakat.kategori.store',
            'update'  => 'minatakat.kategori.update',
            'destroy' => 'minatBakat.kategori.destroy',
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



///////////////////////////////////
    // PESERTA
//////////////////////////////////
    Route::middleware(['role:peserta','verified'])->group(function () {

        Route::get('/', [BerandaController::class, 'index'])->name('beranda');
        Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');

       Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
       Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');


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

// ==============================
// EMAIL VERIFICATION
// ==============================
Route::middleware('auth')->group(function () {

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('/logout', [LoginController::class,'logout'])
        ->name('logout');
});
