<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreakCharacter extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'svg_path',
        'min_level',
         'svg_animated_path',
    'is_default',
    ];

    // Ambil karakter default
    public static function defaultCharacter()
    {
        return self::where('is_default', true)->first();
    }

    // Ambil karakter sesuai level user, fallback ke default
    public static function characterByLevel($level)
    {
        return self::where('min_level', '<=', $level)
            ->orderByDesc('min_level')
            ->first() ?? self::defaultCharacter();
    }
}
