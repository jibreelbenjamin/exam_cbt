<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaketSoalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement([
                'Matematika',
                'IPA',
                'IPS',
                'Bahasa Indonesia',
                'Bahasa Inggris',
                'Sejarah',
                'Geografi',
                'Ekonomi',
                'Sosiologi',
                'Fisika',
                'Kimia',
                'Biologi',
                'Seni Budaya',
                'PJOK',
                'PPKN',
                'TIK',
            ]),
            'deskripsi' => $this->faker->sentence(5),
        ];
    }
}
