<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
     use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'google_id',
        'email_verified_at',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['kode'];
    public function getKodeAttribute()
    {
        return $this->id . '-PGN';
    }

    public function streak()
{
    return $this->hasOne(Streak::class);
}
}

