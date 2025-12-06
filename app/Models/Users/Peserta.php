<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Peserta extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'exam_peserta';
    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'id_kelas', 'id_ruangan', 'username', 'nama', 'password', 'unhashed_password'
    ];

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Resource\Kelas::class, 'id_kelas');
    }

    public function ruangan()
    {
        return $this->belongsTo(\App\Models\Resource\Ruangan::class, 'id_ruangan');
    }

    public function jawaban()
    {
        return $this->hasMany(\App\Models\Resource\JawabanSiswa::class, 'id_peserta');
    }

    public function hasil()
    {
        return $this->hasMany(\App\Models\Resource\HasilUjian::class, 'id_peserta');
    }
}
