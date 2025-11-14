<?php

namespace Database\Factories\Users;

use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'nama' => $this->faker->name(),
            'password' => Hash::make('password'),
            'remember_token' => null,
        ];
    }
}
