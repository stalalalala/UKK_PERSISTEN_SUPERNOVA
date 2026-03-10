<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar Auth dikenali

class Latihan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'set_ke',
        'subtes',
        'durasi',
        'is_active',
        'is_published'
    ];

    public function questions()
    {
        return $this->hasMany(LatihanQuestion::class, 'latihan_id');
    }

    /**
     * Relasi ke Hasil Latihan (Hanya untuk user yang login)
     */
    public function userHasil()
    {
        // Pakai string 'App\Models\HasilLatihan' agar VS Code tidak bingung
        // Pakai Auth::id() agar lebih standar Laravel
        return $this->hasOne('App\Models\HasilLatihan', 'latihan_id')->where('user_id', Auth::id());
    }

    public function getFullTitleAttribute()
    {
        return "{$this->subtes} - {$this->set_ke}";
    }

    public function isComplete()
    {
        return $this->questions()->count() >= 20;
    }

    public function scopeSubtes($query, $subtes)
    {
        return $query->where('subtes', $subtes);
    }
}