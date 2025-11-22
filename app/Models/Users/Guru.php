<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Resource\AksesPaketSoal;

class Guru extends Authenticatable
{
    protected $table = 'exam_guru';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'username',
        'nama',
        'password',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function aksesPaket()
    {
        return $this->hasMany(AksesPaketSoal::class, 'id_guru');
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
}
