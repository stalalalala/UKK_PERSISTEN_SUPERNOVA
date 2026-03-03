<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = ['universitas_id', 'nama_prodi', 'kuota', 'peminat', 'is_deleted', 'deleted_by_univ'];

    public function universitas()
    {
        return $this->belongsTo(Universitas::class, 'universitas_id');
    }
}