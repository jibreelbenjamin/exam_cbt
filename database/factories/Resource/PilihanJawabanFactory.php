<?php

namespace Database\Factories\Resource;

use App\Models\Resource\PilihanJawaban;
use App\Models\Resource\Soal;
use Illuminate\Database\Eloquent\Factories\Factory;

class PilihanJawabanFactory extends Factory
{
    protected $model = PilihanJawaban::class;

    public function definition()
    {
        return [
            'id_soal' => Soal::factory(),
            'gambar' => null,
            'jawaban' => $this->faker->sentence(),
            'is_correct' => false,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($pilihan) {
            $pilihanGroup = PilihanJawaban::where('id_soal', $pilihan->id_soal)->get();

            if ($pilihanGroup->count() === 5) {
                PilihanJawaban::where('id_soal', $pilihan->id_soal)
                    ->update(['is_correct' => false]);

                $pilihanGroup->random()->update(['is_correct' => true]);
            }
        });
    }
}
