<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users\Admin;
use App\Models\Users\Guru;
use App\Models\Users\Siswa;
use App\Models\Resource\Mapel;
use App\Models\Resource\Soal;
use App\Models\Resource\PilihanJawaban;
use App\Models\Resource\Ujian;
use App\Models\Resource\JawabanSiswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ======================================================================
        // KONFIGURASI SEEDER
        // ======================================================================
        $JUMLAH_GURU               = 5;
        $JUMLAH_SISWA              = 30;
        $JUMLAH_MAPEL              = 7;
        $JUMLAH_SOAL               = 250;
        $JUMLAH_PILIHAN_PER_SOAL   = 5;
        $JUMLAH_UJIAN              = 5;
        $JUMLAH_SOAL_PER_UJIAN     = floor($JUMLAH_SOAL / $JUMLAH_UJIAN);
        // ======================================================================

        Admin::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'password' => bcrypt('admin'),
        ]);

        $admins = Admin::factory()->count(2)->create();

        $gurus  = Guru::factory()->count($JUMLAH_GURU)->create();
        $siswa  = Siswa::factory()->count($JUMLAH_SISWA)->create();
        $mapels = Mapel::factory()->count($JUMLAH_MAPEL)->create();

        $soalList = Soal::factory()
            ->count($JUMLAH_SOAL)
            ->make() // editing sebelum insert
            ->each(function ($soal) use ($mapels, $gurus, $JUMLAH_PILIHAN_PER_SOAL) {

                $soal->id_mapel = $mapels->random()->id_mapel;
                $soal->id_guru  = $gurus->random()->id_guru;
                $soal->save();

                PilihanJawaban::factory()
                    ->count($JUMLAH_PILIHAN_PER_SOAL)
                    ->create(['id_soal' => $soal->id_soal]);
            });

        $ujians = Ujian::factory()
            ->count($JUMLAH_UJIAN)
            ->make()
            ->each(function ($ujian) use ($admins, $mapels) {

                $ujian->id_admin = $admins->random()->id_admin;
                $ujian->id_mapel = $mapels->random()->id_mapel;
                $ujian->save();
            });


        // relasi
        foreach ($ujians as $ujian) {
            $soalRandom = Soal::inRandomOrder()->take($JUMLAH_SOAL_PER_UJIAN)->get();

            foreach ($siswa as $sis) {
                foreach ($soalRandom as $soal) {
                    JawabanSiswa::factory()->create([
                        'id_ujian' => $ujian->id_ujian,
                        'id_siswa' => $sis->id_siswa,
                        'id_soal'  => $soal->id_soal,
                    ]);
                }
            }
        }
    }
}
