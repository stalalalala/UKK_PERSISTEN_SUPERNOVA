<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXpLog extends Model
{
    protected $fillable = [
        'user_id',
        'source',
        'xp',
        'xp_date'
    ];

    public $timestamps = false; // kalau memang tabelmu tidak pakai created_at
}