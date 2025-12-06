<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Users\PesertaFactory;

class HasilUjianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_peserta' => PesertaFactory::new(),
            'id_ujian' => UjianFactory::new(),
            'jumlah_benar' => 0,
            'jumlah_salah' => 0,
            'nilai' => 0,
            'waktu_mengerjakan' => null,
            'mulai_mengerjakan' => now(),
            'selesai_mengerjakan' => null,
        ];
    }
}
