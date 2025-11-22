<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
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
