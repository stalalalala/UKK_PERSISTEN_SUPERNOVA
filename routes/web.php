<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/streak', function () {
    return view('streak');
});

Route::get('/tryout', function () {
    return view('tryout.index');
});

Route::get('/intruksi', function () {
    return view('tryout.intructions');
});

Route::get('/latihan', function () {
    return view('latihan.index');
});

Route::get('/video', function () {
    return view('video.index');
});

Route::get('/kuis', function () {
    return view('kuis.index');
});