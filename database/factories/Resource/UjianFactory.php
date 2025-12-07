<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;

class UjianFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_paket_ujian' => PaketUjianFactory::new(),
            'id_paket_soal'  => PaketSoalFactory::new(),
            'token' => false,
            'status' => false,
            'durasi' => $this->faker->numberBetween(30, 120),
            'acak_soal' => false,
            'jadwal_mulai' => now(),
            'jadwal_selesai' => now()->addHours(2),
        ];
    }
}
