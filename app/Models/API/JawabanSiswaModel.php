<?php

namespace App\Models\API;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswaModel extends Model
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
        return $this->belongsTo(UjianModel::class, 'id_ujian');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function soal()
    {
        return $this->belongsTo(SoalModel::class, 'id_soal');
    }
}
