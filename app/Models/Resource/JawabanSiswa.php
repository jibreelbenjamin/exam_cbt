<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    protected $table = 'exam_jawaban_siswa';
    protected $primaryKey = 'id_jawaban_siswa';

    protected $fillable = [
        'id_peserta',
        'id_ujian',
        'id_soal',
        'id_pilihan_jawaban',
        'jawaban_essay',
        'benar',
    ];

    protected $casts = ['benar' => 'boolean'];

    public function peserta()
    {
        return $this->belongsTo(\App\Models\Users\Peserta::class, 'id_peserta');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }

    public function pilihan()
    {
        return $this->belongsTo(PilihanJawaban::class, 'id_pilihan_jawaban');
    }
}
