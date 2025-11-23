<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Resource\Kelas;
use App\Models\Resource\Ruangan;
use App\Models\Resource\JawabanSiswa;
use App\Models\Resource\HasilUjian;

class Peserta extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'exam_peserta';
    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'id_kelas',
        'id_ruangan',
        'username',
        'nama',
        'password',
        'unhashed_password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class, 'id_peserta');
    }

    public function hasil()
    {
        return $this->hasMany(HasilUjian::class, 'id_peserta');
    }
}
