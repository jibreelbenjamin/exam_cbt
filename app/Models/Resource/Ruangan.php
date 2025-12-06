<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'exam_ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $fillable = ['nama'];

    public function peserta()
    {
        return $this->hasMany(\App\Models\Users\Peserta::class, 'id_ruangan');
    }
}
