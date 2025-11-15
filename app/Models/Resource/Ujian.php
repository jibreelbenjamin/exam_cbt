<?php

namespace App\Models\Resource;

use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';
    protected $primaryKey = 'id_ujian';

    protected $fillable = [
        'id_paket_soal',
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
    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'id_paket_soal', 'id_paket_soal');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, 'id_paket_soal', 'id_paket_soal');
        // Because exam uses id_paket_soal to determine soal list
    }
}
