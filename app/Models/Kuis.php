<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kuis extends Model
{
    use SoftDeletes;

    protected $table = 'kuis';

    protected $fillable = [
        'judul',
        'kategori',
        'set_ke',
        'durasi',
        'materi',
        'video_url',
        'is_active',
        'is_published'
    ];

    // ============================
    // RELATIONSHIP
    // ============================
    public function questions()
    {
        return $this->hasMany(KuisQuestion::class, 'kuis_id');
    }
}
