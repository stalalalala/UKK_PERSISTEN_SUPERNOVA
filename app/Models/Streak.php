<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Streak extends Model
{
    protected $fillable = [
        'user_id',
        'total_xp',
        'jumlah_hari',
        'level',
        'last_claim',
        'last_recovery'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
