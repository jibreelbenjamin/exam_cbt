<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    protected $table = 'exam_pilihan_jawaban';
    protected $primaryKey = 'id_pilihan_jawaban';

    protected $fillable = [
        'id_soal',
        'tipe_jawaban',
        'teks_jawaban',
        'gambar',
        'benar',
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
