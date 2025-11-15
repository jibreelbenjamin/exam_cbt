<?php

namespace Database\Factories\Resource;

use App\Models\Resource\Ujian;
use App\Models\Resource\PaketSoal;
use App\Models\Users\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class UjianFactory extends Factory
{
    protected $model = Ujian::class;

    public function definition()
    {
        $start = $this->faker->dateTimeBetween('+1 day', '+2 days');
        $end = (clone $start)->modify('+2 hours');

        return [
            'id_paket_soal' => PaketSoal::factory(),
            'id_admin' => Admin::factory(),
            'nama' => "Ujian " . $this->faker->word(),
            'deskripsi' => $this->faker->sentence(),
            'waktu_mulai' => $start,
            'waktu_selesai' => $end,
            'durasi_menit' => 120,
            'acak_soal' => false,
            'status' => 'nonaktif',
        ];
    }
}
