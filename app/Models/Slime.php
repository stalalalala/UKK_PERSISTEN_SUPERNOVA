<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slime extends Model
{
    protected $fillable = [
        'nama',
        'gambar',
        'level_min',
        'animasi',
        'is_active'
    ];
}
