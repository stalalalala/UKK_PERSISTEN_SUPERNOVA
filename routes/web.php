<?php

use App\Http\Controllers\KuisController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MinatBakatController;
use App\Http\Controllers\StreakController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/profile/index', function () {
    return view('profile.index');
});

// profile

Route::get('/profile/edit', function () {
    return view('profile.edit');
});

// streak
Route::get('/streak', [StreakController::class, 'index'])->name('streak.index');

// tryout

Route::get('/tryout', [TryoutController::class, 'index'])->name('tryout.index');

Route::get('/tryout/intructions', function () {
    return view('tryout.intructions');
});

Route::get('/tryout/jeda', function () {
    return view('tryout.jeda');
});

Route::get('/tryout/ranking', function () {
    return view('tryout.ranking');
});

Route::get('/tryout/soal', function () {
    return view('tryout.soal');
});

Route::get('/tryout/hasil', function () {
    return view('tryout.hasil');
});

//latihan

Route::get('/latihan', [LatihanController::class, 'index'])->name('latihan.index');

Route::get('/hasil_latihan', function () {
    return view('latihan.hasil');
});

// video

Route::get('/video', [VideoController::class, 'index'])->name('video.index');

// kuis

Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');

Route::get('/kuis/hasil', function () {
    return view('kuis.hasil');
});

Route::get('/slime', function () {
    return view('slime');
});

Route::get('/slime_login', function () {
    return view('slime_login');
});

Route::get('/masuk', function () {
    return view('Auth/masuk');
});

Route::get('/daftar', function () {
    return view('Auth/daftar');
});

Route::get('/minat_bakat', [MinatBakatController::class, 'index'])->name('minat_bakat.soal');

Route::get('/minat_bakat/hasil', function () {
    return view('minat_bakat/hasil');
});