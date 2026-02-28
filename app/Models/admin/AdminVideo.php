<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminVideo extends Model
{
    use SoftDeletes;

    protected $table = 'admin_videos';

    protected $fillable = [
        'subtes',
        'judul_video',
        'iframe' 
    ];

    /**
     * Kode unik video
     */
    public function getKodeAttribute()
    {
        return $this->id . '-VID';
    }

}
