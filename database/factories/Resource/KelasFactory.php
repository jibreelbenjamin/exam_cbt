<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    public function definition(): array
    {
        $kelas = $this->faker->randomElement([
                'X',
                'XI',
                'XII',
        ]) . ' ' . $this->faker->randomElement([
                'MIPA',
                'IPS',
                'BAHASA',
            ]) . '-' . ucfirst($this->faker->randomLetter(true)) . $this->faker->randomDigit();
        return [
            'nama' => $kelas,
        ];
    }
}
