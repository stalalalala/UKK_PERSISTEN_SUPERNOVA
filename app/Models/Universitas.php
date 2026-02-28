<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universitas extends Model {
    protected $fillable = ['nama_univ', 'lokasi'];
    public function prodis() { return $this->hasMany(Prodi::class); }
}