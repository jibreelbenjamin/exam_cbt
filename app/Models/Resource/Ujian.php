<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'exam_ujian';
    protected $primaryKey = 'id_ujian';

    protected $fillable = [
        'id_paket_ujian',
        'id_paket_soal',
        'token',
        'token_expired_at',
        'status',
        'durasi_menit',
        'acak_soal',
        'jadwal_mulai',
        'jadwal_selesai',
    ];

    protected $casts = [
        'status' => 'boolean',
        'acak_soal' => 'boolean',
        'jadwal_mulai' => 'datetime',
        'jadwal_selesai' => 'datetime',
        'token_expired_at' => 'datetime',
    ];

    public function paketUjian()
    {
        return $this->belongsTo(PaketUjian::class, 'id_paket_ujian');
    }

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket_soal');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class, 'id_ujian');
    }

    public function hasil()
    {
        return $this->hasMany(HasilUjian::class, 'id_ujian');
    }
}
