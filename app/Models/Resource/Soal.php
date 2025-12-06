<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'exam_soal';
    protected $primaryKey = 'id_soal';
    protected $fillable = ['id_paket_soal', 'teks_soal', 'gambar'];

    public function paket()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket_soal');
    }

    public function pilihan()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_soal');
    }
}
