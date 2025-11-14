<?php

namespace Database\Factories\Resource;

use App\Models\Resource\Mapel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MapelFactory extends Factory
{
    protected $model = Mapel::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement([
                'Matematika', 'IPA', 'IPS', 'Bahasa Indonesia', 'Bahasa Inggris', 'Sejarah', 'Seni Budaya', 'PJOK', 'TIK', 'PPKN'
            ]),
        ];
    }
}
