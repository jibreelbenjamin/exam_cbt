<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'exam_guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = ['username', 'nama', 'password'];

    protected $hidden = ['password'];

    public function aksesPaket()
    {
        return $this->hasMany(\App\Models\Resource\AksesPaketSoal::class, 'id_guru');
    }

    public function paketSoal()
    {
        return $this->belongsToMany(
            \App\Models\Resource\PaketSoal::class,
            'exam_akses_paket_soal',
            'id_guru',
            'id_paket_soal'
        );
    }

    public function aksesPaketSoal()
    {
        return $this->hasMany(\App\Models\Resource\AksesPaketSoal::class, 'id_guru');
    }
}
