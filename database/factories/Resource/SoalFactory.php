<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class SoalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_paket_soal' => PaketSoalFactory::new(),
            'teks_soal' => $this->faker->sentence(10),
            'gambar' => null,
            'tipe_jawaban' => 1,
        ];
    }
}
