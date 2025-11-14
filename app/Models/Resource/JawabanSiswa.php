<?php

namespace App\Models\Resource;

use App\Models\Users\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';
    protected $primaryKey = 'id_jawaban_siswa';

    protected $fillable = [
        'id_ujian',
        'id_siswa',
        'id_soal',
        'jawaban',
        'is_correct',
        'waktu_selesai',
        'waktu_jawab',
    ];

    // relasi nya lek
    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
