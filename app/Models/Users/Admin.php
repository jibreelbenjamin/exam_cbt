<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'exam_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username', 'nama', 'password',
    ];

    public function examTokens()
    {
        return $this->hasMany(\App\Models\Resource\Token::class, 'id_admin');
    }
}
