<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;

class MapelModel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';
    protected $fillable = [
        'nama_mapel',
        'nama'
    ];
}
