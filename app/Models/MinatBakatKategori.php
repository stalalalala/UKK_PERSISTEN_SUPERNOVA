<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinatBakatKategori extends Model
{
    protected $table = 'minatbakat_kategori';
    protected $fillable = ['name','description', 'soal', 'color'];

    public function soals()
    {
        // Hubungkan kolom 'name' di tabel ini ke kolom 'kategori_name' di tabel Soal
        return $this->hasMany(MinatBakatSoal::class, 'kategori_name', 'name');
    }
}
