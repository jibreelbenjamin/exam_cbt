<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Resource\PaketSoal;
use App\Models\Users\Guru;

class AksesPaketSoalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_paket_soal' => PaketSoal::inRandomOrder()->first()->id_paket_soal ?? PaketSoal::factory()->create()->id_paket_soal,
            'id_guru' => Guru::inRandomOrder()->first()->id_guru ?? Guru::factory()->create()->id_guru,
        ];
    }
}
