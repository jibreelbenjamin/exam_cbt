<?php

namespace App\Models\API;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianModel extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';

    protected $fillable = [
        'id_mapel',
        'id_admin',
        'nama_ujian',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'durasi_menit',
        'acak_soal',
        'status'
    ];

    // relasi rek
    public function mapel()
    {
        return $this->belongsTo(MapelModel::class, 'id_mapel', 'id_mapel');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function soal()
    {
        return $this->hasMany(SoalModel::class, 'id_mapel', 'id_mapel');
        // Because exam uses id_mapel to determine soal list
    }
}
