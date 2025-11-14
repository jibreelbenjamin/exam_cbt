<?php

namespace Database\Factories\Resource;

use App\Models\Resource\JawabanSiswa;
use App\Models\Resource\Ujian;
use App\Models\Users\Siswa;
use App\Models\Resource\Soal;
use Illuminate\Database\Eloquent\Factories\Factory;

class JawabanSiswaFactory extends Factory
{
    protected $model = JawabanSiswa::class;

    public function definition()
    {
        return [
            'id_ujian' => Ujian::factory(),
            'id_siswa' => Siswa::factory(),
            'id_soal' => Soal::factory(),
            'jawaban' => $this->faker->randomElement([
                $this->faker->sentence(),
                null
            ]),
            'is_correct' => null,
            'waktu_selesai' => now(),
            'waktu_jawab' => now(),
        ];
    }
}
