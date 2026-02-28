<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilMinatBakat extends Model
{
    use HasFactory;

    // Tambahkan user_id dan kolom lainnya ke dalam array fillable
    protected $fillable = [
        'user_id', 
        'top_1', 
        'top_2', 
        'top_3'
    ];
}