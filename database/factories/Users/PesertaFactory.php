<?php

namespace Database\Factories\Users;

use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Resource\KelasFactory;
use Database\Factories\Resource\RuanganFactory;
use Illuminate\Support\Facades\Hash;

class PesertaFactory extends Factory
{
    public function definition(): array
    {
        $password = $this->faker->regexify('[A-Z]{5}[0-4]{3}');
        return [
            'id_kelas'   => KelasFactory::new(),
            'id_ruangan' => RuanganFactory::new(),
            'username'   => $this->faker->unique()->numerify('#####/####.###'),
            'nama'       => $this->faker->name(),
            'password'   => Hash::make($password),
            'unhashed_password' => $password,
        ];
    }
}
