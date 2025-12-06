<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesPaketSoal extends Model
{
    use HasFactory;

    protected $table = 'exam_akses_paket_soal';
    protected $primaryKey = 'id_akses_paket_soal';

    protected $fillable = ['id_paket_soal', 'id_guru'];

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket_soal');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}
