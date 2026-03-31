<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreakRestore extends Model
{
    protected $fillable = [
    'user_id',
    'restore_date',
];
}
