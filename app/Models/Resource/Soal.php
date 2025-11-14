<?php

namespace App\Models\Resource;

use App\Models\Users\Guru;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
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
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_soal', 'id_soal');
    }
}
