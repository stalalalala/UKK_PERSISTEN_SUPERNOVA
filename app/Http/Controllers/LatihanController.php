<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
{
    $latihans = Latihan::where('is_published', true)
        ->where('is_active', true)
        ->orderBy('subtes')
        ->orderBy('set_ke')
        ->get()
        ->groupBy('subtes'); // ← penting

        $subtesMap = [
    'Penalaran Umum' => 'PU',
    'Pengetahuan & Pemahaman Umum' => 'PPU',
    'Pemahaman Bacaan & Menulis' => 'PBM',
    'Pengetahuan Kuantitatif' => 'PK',
    'Penalaran Matematika' => 'PM',
    'Literasi Bahasa Indonesia' => 'LBI',
    'Literasi Bahasa Inggris' => 'LBE',
];

    return view('latihan.index', compact('latihans', 'subtesMap'));
}
}
