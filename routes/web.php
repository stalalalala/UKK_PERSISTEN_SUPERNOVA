<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\PasswordForgotController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Auth;
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
        Route::resource('peluangPtn', HalamanPeluangPtnController::class)->names('peluang');
        Route::resource('monitoringLaporan', HalamanMonitoringLaporanController::class)->names('laporan');
        Route::resource('tryout', AdminTryoutController::class);
        Route::resource('kuis', AdminKuisController::class);
        Route::resource('latihan', AdminLatihanController::class);

        Route::get('videoPembelajaran/history', [AdminVideoController::class, 'history'])->name('videoPembelajaran.history');
        Route::post('videoPembelajaran/{id}/restore', [AdminVideoController::class, 'restore'])->name('videoPembelajaran.restore');
        Route::delete('videoPembelajaran/{id}/force-delete', [AdminVideoController::class, 'forceDelete'])->name('videoPembelajaran.force-delete');
        Route::post('videoPembelajaran/import',
            [AdminVideoController::class, 'import'])->name('videoPembelajaran.import');

        Route::resource('videoPembelajaran', AdminVideoController::class);

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

       Route::resource('minatBakat', AdminMinatBakatController::class);
    });



///////////////////////////////////
    // PESERTA
//////////////////////////////////
    Route::middleware(['role:peserta','verified'])->group(function () {

        Route::get('/', [BerandaController::class, 'index'])->name('beranda');
        Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile.index');

       Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
       Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

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
