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
        'link'
    ];

   
    public function getKodeAttribute()
    {
        return $this->id . '-VID';
    }

   
    public function getEmbedAttribute()
    {
        if (str_contains($this->link, 'watch?v=')) {
            return str_replace('watch?v=', 'embed/', $this->link);
        }

        return $this->link;
    }

}
