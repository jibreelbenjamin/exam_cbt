<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'exam_ujian';
    protected $primaryKey = 'id_ujian';

    protected $fillable = [
        'id_paket_ujian', 'id_paket_soal',
        'token', 'status', 'durasi_menit',
        'acak_soal', 'jadwal_mulai', 'jadwal_selesai'
    ];

    public function paketUjian()
    {
        return $this->belongsTo(PaketUjian::class, 'id_paket_ujian');
    }

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket_soal');
    }

    public function tokenUjian()
    {
        return $this->hasMany(Token::class, 'id_ujian');
    }

    public function hasil()
    {
        return $this->hasMany(HasilUjian::class, 'id_ujian');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class, 'id_ujian');
    }
}
