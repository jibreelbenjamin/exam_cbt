<?php

namespace Database\Factories\Users;

use App\Models\Users\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class GuruFactory extends Factory
{
    protected $model = Guru::class;

    public function definition()
    {
        return [
            'nip' => $this->faker->unique()->numerify('1980#########'),
            'nama' => $this->faker->name(),
            'password' => Hash::make('password'),
            'remember_token' => null,
        ];
    }
}
