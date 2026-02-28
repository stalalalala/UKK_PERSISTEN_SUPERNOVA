<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilLatihan extends Model
{
    protected $fillable = [
        'user_id',
        'latihan_id',
        'skor',
        'benar',
        'salah',
        'kosong',
    ];
}