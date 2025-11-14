<?php

namespace App\Models\API;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalModel extends Model
{
    use HasFactory;

    protected $table = 'soal';
    protected $primaryKey = 'id_soal';

    protected $fillable = [
        'id_mapel',
        'id_guru',
        'gambar',
        'pertanyaan',
        'jawaban',
        'jenis'
    ];

    public function mapel()
    {
        return $this->belongsTo(MapelModel::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function pilihan()
    {
        return $this->hasMany(PilihanJawabanModel::class, 'id_soal', 'id_soal');
    }
}
