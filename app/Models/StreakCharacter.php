<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreakCharacter extends Model
{
    protected $fillable = [
        'nama',
        'svg_path',
        'min_level',
        'animation'
    ];

     use SoftDeletes;
}
