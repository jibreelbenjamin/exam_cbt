<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'exam_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'nama',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function ujian()
    {
        return $this->hasMany(\App\Models\Resource\Ujian::class, 'id_admin');
    }
}
