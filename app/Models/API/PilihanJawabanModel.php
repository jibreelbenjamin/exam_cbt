<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanJawabanModel extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawaban';
    protected $primaryKey = 'id_pilihan';

    protected $fillable = [
        'id_soal',
        'gambar',
        'jawaban',
        'is_correct'
    ];

    public function soal()
    {
        return $this->belongsTo(SoalModel::class, 'id_soal', 'id_soal');
    }
}
