<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaketUjianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Ujian ' . $this->faker->word(),
        ];
    }
}
