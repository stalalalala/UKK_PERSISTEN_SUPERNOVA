<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'latihan_id',
        'materi',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'pembahasan'
    ];

    /**
     * Relasi kembali ke Set Latihan
     */
    public function latihan()
    {
        return $this->belongsTo(Latihan::class, 'latihan_id');
    }
}