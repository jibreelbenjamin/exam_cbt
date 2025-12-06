<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

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

    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_paket_soal');
    }

    public function aksesPaketSoal()
    {
        return $this->hasMany(\App\Models\Resource\AksesPaketSoal::class, 'id_paket_soal');
    }
}
