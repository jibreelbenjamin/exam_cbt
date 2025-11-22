<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'exam_kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = ['nama'];

    public function peserta()
    {
        return $this->hasMany(\App\Models\Users\Peserta::class, 'id_kelas');
    }
}
