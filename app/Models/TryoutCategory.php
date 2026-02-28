<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TryoutCategory extends Model
{
    protected $table = 'tryout_categories';

    // WAJIB: Tambahkan ini agar data bisa disimpan dari Controller
    protected $fillable = [
        'admin_tryout_id',
        'nama_kategori',
        'durasi',
    ];

    public function adminTryout(): BelongsTo
    {
        return $this->belongsTo(AdminTryout::class, 'admin_tryout_id');
    }

    public function soals(): HasMany
    {
        return $this->hasMany(SoalTryout::class, 'category_id');
    }
}