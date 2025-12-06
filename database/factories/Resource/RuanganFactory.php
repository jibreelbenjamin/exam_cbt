<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class RuanganFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Ruang ' . $this->faker->randomDigitNotNull(),
        ];
    }
}
