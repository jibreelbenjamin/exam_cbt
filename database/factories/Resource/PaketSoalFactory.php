<?php

namespace Database\Factories\Resource;

use App\Models\Resource\PaketSoal;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaketSoalFactory extends Factory
{
    protected $model = PaketSoal::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement([
                'Matematika', 'IPA', 'IPS', 'Bahasa Indonesia', 'Bahasa Inggris', 'Sejarah', 'Seni Budaya', 'PJOK', 'TIK', 'PPKN'
            ]),
        ];
    }
}
