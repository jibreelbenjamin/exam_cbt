<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPeserta extends Model
{
    use HasFactory;

    protected $table = 'exam_jawaban_peserta';
    protected $primaryKey = 'id_jawaban_peserta';

    protected $fillable = [
        'id_peserta', 'id_ujian', 'id_soal',
        'id_pilihan_jawaban', 'jawaban_essay', 'benar'
    ];

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
