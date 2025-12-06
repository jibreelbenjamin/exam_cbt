<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Users\Admin;
use App\Models\Resource\Ujian;

class TokenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_admin' => Admin::inRandomOrder()->first()->id_admin ?? Admin::factory()->create()->id_admin,
            'id_ujian' => Ujian::inRandomOrder()->first()->id_ujian ?? Ujian::factory()->create()->id_ujian,
            'token' => $this->faker->regexify('[A-Z]{3}[0-4]{3}'),
            'durasi' => $this->faker->numberBetween(20, 120),
            'token_expired_at' => now()->addMinutes(30),
        ];
    }
}
