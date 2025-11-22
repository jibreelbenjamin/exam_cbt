<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = 'exam_hasil_ujian';
    protected $primaryKey = 'id_hasil_ujian';

    protected $fillable = [
        'id_peserta',
        'id_ujian',
        'jumlah_benar',
        'jumlah_salah',
        'nilai',
        'waktu_mengerjakan',
        'mulai_mengerjakan',
        'selesai_mengerjakan',
    ];

    protected $casts = [
        'mulai_mengerjakan' => 'datetime',
        'selesai_mengerjakan' => 'datetime',
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
