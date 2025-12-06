<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketUjian extends Model
{
    use HasFactory;

    protected $table = 'exam_paket_ujian';
    protected $primaryKey = 'id_paket_ujian';
    protected $fillable = ['nama'];

    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_paket_ujian');
    }
}
