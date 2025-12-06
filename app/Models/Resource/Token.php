<?php

namespace App\Models\Resource;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = 'exam_token';
    protected $primaryKey = 'id_token';

    protected $fillable = [
        'id_admin', 'id_ujian', 'token', 'durasi', 'token_expired_at'
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian');
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\Users\Admin::class, 'id_admin');
    }
}
