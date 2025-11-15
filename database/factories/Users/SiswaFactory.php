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
        $password = $this->faker->regexify('[A-Z]{5}[0-4]{3}');
        return [
            'nis' => $this->faker->unique()->numerify('2025#####'),
            'nama' => $this->faker->name(),
            'password' => Hash::make($password),
            'unhashed_password' => $password,
            'remember_token' => null,
        ];
    }
}
