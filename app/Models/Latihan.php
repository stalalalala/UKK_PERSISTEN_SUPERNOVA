<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    /**
     * Relasi ke soal (Satu set punya banyak soal)
     */
    public function questions()
    {
        return $this->hasMany(LatihanQuestion::class, 'latihan_id');
    }

    /**
     * Accessor untuk Judul Otomatis (Full Title)
     * Contoh penggunaan di blade: {{ $latihan->full_title }}
     * Hasil: "Pengetahuan Kuantitatif - Set 1"
     */
    public function getFullTitleAttribute()
    {
        return "{$this->subtes} - {$this->set_ke}";
    }

    /**
     * Helper untuk cek apakah sudah mencapai 20 soal
     * Bisa digunakan di Controller atau Blade untuk validasi publish
     */
    public function isComplete()
    {
        return $this->questions()->count() >= 20;
    }

    /**
     * Scope untuk filter berdasarkan subtes
     * Contoh: Latihan::subtes('PK')->get();
     */
    public function scopeSubtes($query, $subtes)
    {
        return $query->where('subtes', $subtes);
    }
}