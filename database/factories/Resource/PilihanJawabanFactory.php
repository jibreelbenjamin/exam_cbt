<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class PilihanJawabanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_soal' => SoalFactory::new(),
            'teks_jawaban' => $this->faker->sentence(4),
            'gambar' => null,
            'benar' => false,
        ];
    }
}
