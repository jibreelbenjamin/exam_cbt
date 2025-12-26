<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    use HasFactory;

    protected $table = 'exam_pilihan_jawaban';
    protected $primaryKey = 'id_pilihan_jawaban';

    protected $fillable = [
        'id_soal', 'teks_jawaban', 'benar'
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'id_soal');
    }
}
