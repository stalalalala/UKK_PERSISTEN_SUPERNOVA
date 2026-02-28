<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class AdminTryout extends Model
{
    protected $table = 'admin_tryouts';

    protected $fillable = [
        'nama_tryout',
        'tanggal',
        'tanggal_akhir',
        'payload_full_data',
        'id_pengguna',
    ];

    protected $casts = [
    'tanggal' => 'date',
    'tanggal_akhir' => 'date',
];

    // 1. Relasi ke Kategori (menggunakan admin_tryout_id)
    public function categories(): HasMany
    {
        return $this->hasMany(TryoutCategory::class, 'admin_tryout_id');
    }

    // 2. Relasi ke Soal (melalui kategori)
    public function soals(): HasManyThrough
    {
        return $this->hasManyThrough(
            SoalTryout::class, 
            TryoutCategory::class, 
            'admin_tryout_id',
            'category_id',
            'id',
            'id'
        );
    }
}