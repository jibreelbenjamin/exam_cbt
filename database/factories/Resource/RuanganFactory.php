<?php

namespace Database\Factories\Resource;

use App\Models\Resource\Ruangan;
use Illuminate\Database\Eloquent\Factories\Factory;

class RuanganFactory extends Factory
{
    protected $model = Ruangan::class;

    public function definition(): array
    {
        return [
            'nama' => 'Ruang ' . $this->faker->randomElement([
                'A1','A2','A3','B1','B2','B3','Lab 1','Lab 2','Perpustakaan'
            ]),
        ];
    }
}
