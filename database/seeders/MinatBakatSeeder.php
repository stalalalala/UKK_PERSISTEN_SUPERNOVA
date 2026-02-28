<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinatBakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
    $soal = [
        ['pertanyaan' => 'Saya suka menganalisis data dan angka.', 'kategori' => 'Investigative'],
        ['pertanyaan' => 'Saya senang menggambar atau mendesain sesuatu.', 'kategori' => 'Artistic'],
        ['pertanyaan' => 'Saya suka memimpin tim dalam sebuah proyek.', 'kategori' => 'Enterprising'],
        // Tambahkan sampai 50 soal dengan kategori yang tersebar adil
    ];
    foreach($soal as $s) { \App\Models\MinatBakat::create($s); }
}
}
