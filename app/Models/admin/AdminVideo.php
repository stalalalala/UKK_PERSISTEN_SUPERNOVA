<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminVideo extends Model
{
    use SoftDeletes; 

    protected $table = 'admin_videos';
    protected $primaryKey = 'video_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['video_id', 'subtes', 'judul_video', 'link'];

}
