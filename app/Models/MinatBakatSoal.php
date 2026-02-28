<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MinatBakatSoal extends Model
{
    use HasFactory;
    
    protected $fillable = ['kategori_name', 'text'];

    // TAMBAHKAN INI:
    public function kategori()
    {
        // Kita hubungkan kolom 'kategori_name' di tabel ini ke kolom 'name' di tabel Kategori
        return $this->belongsTo(MinatBakatKategori::class, 'kategori_name', 'name');
    }
}