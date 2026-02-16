<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\AdminKuisController;
use App\Http\Controllers\admin\AdminLatihanController;
use App\Http\Controllers\admin\AdminMinatBakatController;
use App\Http\Controllers\admin\AdminTryoutController;
use App\Http\Controllers\admin\AdminVideoController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HalamanStreakController;
use App\Http\Controllers\admin\HalamanPeluangPtnController;
use App\Http\Controllers\admin\HalamanMonitoringLaporanController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\StreakController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HasilKuisController;
use App\Http\Controllers\HasilLatihanController;
use App\Http\Controllers\HasilTryoutController;
use App\Http\Controllers\IntruksiKuisController;
use App\Http\Controllers\IntruksiLatihanController;
use App\Http\Controllers\InstruksiMinatBakatController;
use App\Http\Controllers\IntruksiTryoutController;
use App\Http\Controllers\JedaTryoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SoalKuisController;
use App\Http\Controllers\SoalLatihanController;
use App\Http\Controllers\SoalTryoutController;

// =========================================================
// 1. GUEST ROUTES (Belum Login)
// =========================================================
Route::middleware('guest')->group(function () {
    Route::get('/masuk', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/masuk', [LoginController::class, 'login']);
    
    Route::get('/daftar', function () {
        return view('Auth.daftar');
    })->name('register');
});

// =========================================================
// 2. AUTH ROUTES (Sudah Login)
// =========================================================
Route::middleware('auth')->group(function () {

    // Action Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // -----------------------------------------------------
    // ROLE: ADMIN
    // -----------------------------------------------------
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('dashboard', DashboardController::class)->only(['index']);
        // Pastikan User model sudah di-import jika menggunakan resource
        Route::resource('user', UserController::class); 
        Route::resource('streak', HalamanStreakController::class);
        Route::resource('peluangPtn', HalamanPeluangPtnController::class)->names('peluang');
        Route::resource('monitoringLaporan', HalamanMonitoringLaporanController::class)->names('laporan');
        Route::resource('tryout', AdminTryoutController::class);
        Route::resource('kuis', AdminKuisController::class);
        Route::resource('latihan', AdminLatihanController::class);
        Route::resource('videoPembelajaran', AdminVideoController::class);

        Route::get('minatbakat/editor', [AdminMinatBakatController::class, 'editor'])->name('minatbakat.editor');
        Route::get('minatbakat/kategori', [AdminMinatBakatController::class, 'kategori'])->name('minatbakat.kategori');
        Route::get('minatbakat/partisipasi', [AdminMinatBakatController::class, 'partisipasi'])->name('minatbakat.partisipasi');
        Route::resource('minatBakat', AdminMinatBakatController::class);
    });

    // -----------------------------------------------------
    // ROLE: PESERTA
    // -----------------------------------------------------
    Route::middleware('role:peserta')->group(function () {
        
        // Dashboard / Beranda Peserta
        Route::get('/', [BerandaController::class, 'index'])->name('beranda');

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', function () {
            return view('profile.edit');
        })->name('profile.edit');

        // Fitur Dasar
        Route::get('/streak', [StreakController::class, 'index'])->name('streak.index');
        Route::get('/video', [VideoController::class, 'index'])->name('video.index');

        // Tryout
        Route::prefix('tryout')->name('tryout.')->group(function () {
            Route::get('/', [TryoutController::class, 'index'])->name('index');
            Route::get('/intruksi', [IntruksiTryoutController::class, 'index'])->name('intruksi');
            Route::get('/jeda', [JedaTryoutController::class, 'index'])->name('jeda');
            Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');
            Route::get('/soal', [SoalTryoutController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilTryoutController::class, 'index'])->name('hasil');
        });

        // Latihan
        Route::prefix('latihan')->name('latihan.')->group(function () {
            Route::get('/', [LatihanController::class, 'index'])->name('index');
            Route::get('/soal', [SoalLatihanController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilLatihanController::class, 'index'])->name('hasil');
            Route::get('/intruksi', [IntruksiLatihanController::class, 'index'])->name('intruksi');
        });

        // Kuis
        Route::prefix('kuis')->name('kuis.')->group(function () {
            Route::get('/', [KuisController::class, 'index'])->name('index');
            Route::get('/soal', [SoalKuisController::class, 'index'])->name('soal');
            Route::get('/hasil', [HasilKuisController::class, 'index'])->name('hasil');
            Route::get('/intruksi', [IntruksiKuisController::class, 'index'])->name('intruksi');
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
