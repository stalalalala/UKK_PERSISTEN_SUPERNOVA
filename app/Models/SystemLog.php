<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    use HasFactory;

    protected $table = 'system_logs';

    protected $fillable = [
        'id_pengguna', // Pastikan ini ada!
        'title',
        'category',
        'description',
        'status'
    ];

    // Relasi ke User (Opsional tapi disarankan agar nama admin muncul)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}