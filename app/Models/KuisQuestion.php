<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisQuestion extends Model
{
    protected $table = 'kuis_questions';

    protected $fillable = [
        'kuis_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'bobot'
    ];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class);
    }
}
