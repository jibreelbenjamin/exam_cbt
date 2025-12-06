<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaketSoalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Paket ' . $this->faker->word(),
            'deskripsi' => $this->faker->sentence(5),
        ];
    }
}
