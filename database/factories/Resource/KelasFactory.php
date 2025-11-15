<?php

namespace Database\Factories\Resource;

use App\Models\Resource\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

class KelasFactory extends Factory
{
    protected $model = Kelas::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement([
                'IPA 1', 'IPA 2',
                'IPS 1', 'IPS 2',
                'RPL 1', 'RPL 2'
            ]),
            'tingkat' => $this->faker->randomElement(['X', 'XI', 'XII']),
        ];
    }
}
