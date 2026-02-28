<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKuis extends Model
{
    use HasFactory;

    // Nama tabelnya
    protected $table = 'hasil_kuis';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'kuis_id',
        'skor',
        'benar',
        'salah',
        'kosong'
    ];

    /**
     * Relasi ke User (Satu hasil dimiliki oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kuis (Satu hasil merujuk ke satu kuis)
     */
    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}