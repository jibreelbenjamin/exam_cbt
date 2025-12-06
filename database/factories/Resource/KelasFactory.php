<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Kelas ' . $this->faker->randomLetter() . $this->faker->randomDigit(),
        ];
    }
}
