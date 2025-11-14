<?php

namespace Database\Factories\Users;

use App\Models\Users\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition()
    {
        return [
            'nis' => $this->faker->unique()->numerify('2025#####'),
            'nama' => $this->faker->name(),
            'password' => Hash::make('password'),
            'remember_token' => null,
        ];
    }
}
