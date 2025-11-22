<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    protected $table = 'exam_paket_soal';
    protected $primaryKey = 'id_paket_soal';

    protected $fillable = ['nama', 'deskripsi'];

    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_paket_soal');
    }

    public function guru()
    {
        return $this->belongsToMany(
            \App\Models\Users\Guru::class,
            'exam_akses_paket_soal',
            'id_paket_soal',
            'id_guru'
        );
    }

    public function akses()
    {
        return $this->hasMany(AksesPaketSoal::class, 'id_paket_soal');
    }
}
