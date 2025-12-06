<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Users\PesertaFactory;

class JawabanSiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_peserta' => PesertaFactory::new(),
            'id_ujian' => UjianFactory::new(),
            'id_soal' => SoalFactory::new(),
            'id_pilihan_jawaban' => PilihanJawabanFactory::new(),
            'jawaban_essay' => null,
            'benar' => false,
        ];
    }
}
