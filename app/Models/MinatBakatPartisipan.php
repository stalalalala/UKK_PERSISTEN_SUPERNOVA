<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinatBakatPartisipan extends Model
{
    protected $table = 'minatbakat_partisipan'; // Nama tabel manual
    protected $fillable = [
    'name', 
    'hasil', 
    'skor', 
    'top_1', 
    'top_2', 
    'top_3', 
    'tgl'
];
    protected $casts = [
    'skor' => 'array',
];
}
