<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoalTryout extends Model
{
    protected $table = 'soal_tryouts';

    // WAJIB: Tambahkan semua kolom yang ada di form/excel kamu
    protected $fillable = [
        'category_id',
        'materi_teks',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'pembahasan',
        'image_url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TryoutCategory::class, 'category_id');
    }
}