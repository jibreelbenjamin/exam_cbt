<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianPeserta extends Model
{
    use HasFactory;

    protected $table = 'exam_ujian_peserta';
    protected $primaryKey = 'id_ujian_peserta';

    protected $fillable = [
        'id_peserta', 'id_ujian', 'jumlah_benar', 'jumlah_salah',
        'nilai', 'waktu_mengerjakan', 'mulai_mengerjakan', 'selesai_mengerjakan'
    ];

    public function peserta()
    {
        return $this->belongsTo(\App\Models\Users\Peserta::class, 'id_peserta');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian');
    }
}
