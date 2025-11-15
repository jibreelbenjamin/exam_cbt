<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaketSoal extends Model
{
    use HasFactory;

    protected $table = 'paket_soal';
    protected $primaryKey = 'id_paket_soal';
    protected $fillable = [
        'nama_paket_soal',
        'nama'
    ];
}
