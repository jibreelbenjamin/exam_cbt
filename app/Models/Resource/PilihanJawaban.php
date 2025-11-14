<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanJawaban extends Model
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
        return $this->belongsTo(Soal::class, 'id_soal', 'id_soal');
    }
}
