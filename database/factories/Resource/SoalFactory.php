<?php

namespace Database\Factories\Resource;

use App\Models\Resource\Soal;
use App\Models\Resource\PaketSoal;
use App\Models\Users\Guru;
use Illuminate\Database\Eloquent\Factories\Factory;

class SoalFactory extends Factory
{
    protected $model = Soal::class;

    public function definition()
    {
        return [
            'id_paket_soal' => PaketSoal::factory(),
            'id_guru' => Guru::factory(),
            'gambar' => null,
            'pertanyaan' => $this->faker->sentence(10),
            'jawaban' => $this->faker->sentence(5),
            'jenis' => $this->faker->randomElement(['pilihan_ganda', 'essay']),
        ];
    }
}
