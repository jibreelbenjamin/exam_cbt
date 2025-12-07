<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\Users\Admin;
use App\Models\Users\Guru;
use App\Models\Users\Peserta;
use App\Models\Resource\AksesPaketSoal;
use App\Models\Resource\Kelas;
use App\Models\Resource\Ruangan;
use App\Models\Resource\PaketSoal;
use App\Models\Resource\Soal;
use App\Models\Resource\PilihanJawaban;
use App\Models\Resource\PaketUjian;
use App\Models\Resource\Token;
use App\Models\Resource\Ujian;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Config
        $jumlahGuru      = 10;
        $jumlahKelas     = 4;
        $jumlahRuangan   = 5;
        $jumlahPeserta   = 100;
        $jumlahPaket     = 5;
        $jumlahSoal      = 30;
        $jumlahPilihan   = 5;
        $jumlahToken     = 3;
        $jumlahPaketUji  = 3;

        Admin::create([
            'username' => 'admin',
            'nama' => 'Administrator',
            'password' => Hash::make('admin'),
        ]);

        Guru::create([
            'username' => 'guru',
            'nama' => 'Guru',
            'password' => Hash::make('guru'),
        ]);

        $dataKelas = Kelas::factory()->count($jumlahKelas)->create();
        $dataRuangan = Ruangan::factory()->count($jumlahRuangan)->create();

        Peserta::create([
            'username' => 'peserta',
            'nama' => 'Peserta uji coba',
            'id_kelas' => $dataKelas->first()->id_kelas,
            'id_ruangan' => null,
            'password' => Hash::make('peserta'),
            'unhashed_password' => 'peserta',
        ]);

        $dataGuru = Guru::factory()->count($jumlahGuru)->create();
        Token::factory()->count($jumlahToken)->create();

        $basePerKelas = intdiv($jumlahPeserta, $jumlahKelas);
        $sisaKelas = $jumlahPeserta % $jumlahKelas;

        $globalIndex = 1;

        foreach ($dataKelas as $indexKelas => $kelas) {
            $pesertaDiKelas = $basePerKelas + ($sisaKelas > 0 ? 1 : 0);
            if ($sisaKelas > 0) $sisaKelas--;

            $ruanganUntukKelas = $dataRuangan;
            $countRuangan = $ruanganUntukKelas->count();

            if ($countRuangan === 0) {
                for ($i = 0; $i < $pesertaDiKelas; $i++) {
                    Peserta::create([
                        'username' => 'peserta' . $globalIndex,
                        'nama' => 'Peserta ' . $globalIndex,
                        'id_kelas' => $kelas->id_kelas,
                        'id_ruangan' => null,
                        'password' => Hash::make('password'),
                        'unhashed_password' => 'password',
                    ]);
                    $globalIndex++;
                }
                continue;
            }

            $basePerRuangan = intdiv($pesertaDiKelas, $countRuangan);
            $sisaRuangan = $pesertaDiKelas % $countRuangan;

            foreach ($ruanganUntukKelas as $ruangan) {
                $assignCount = $basePerRuangan + ($sisaRuangan > 0 ? 1 : 0);
                if ($sisaRuangan > 0) $sisaRuangan--;

                for ($j = 0; $j < $assignCount; $j++) {
                    Peserta::create([
                        'username' => 'peserta' . $globalIndex,
                        'nama' => 'Peserta ' . $globalIndex,
                        'id_kelas' => $kelas->id_kelas,
                        'id_ruangan' => $ruangan->id_ruangan,
                        'password' => Hash::make('password'),
                        'unhashed_password' => 'password',
                    ]);
                    $globalIndex++;
                }
            }
        }

        $createdPesertaCount = Peserta::count();
        if ($createdPesertaCount < ($jumlahPeserta + 1)) {
            $needed = ($jumlahPeserta + 1) - $createdPesertaCount;
            $firstKelas = $dataKelas->first();
            $firstRuangan = $dataRuangan->first();
            for ($k = 0; $k < $needed; $k++) {
                Peserta::create([
                    'username' => 'peserta' . $globalIndex,
                    'nama' => 'Peserta ' . $globalIndex,
                    'id_kelas' => $firstKelas->id_kelas,
                    'id_ruangan' => $firstRuangan ? $firstRuangan->id_ruangan : null,
                    'password' => Hash::make('password'),
                    'unhashed_password' => 'password',
                ]);
                $globalIndex++;
            }
        }

        $paketSoal = PaketSoal::factory()->count($jumlahPaket)->create();

        foreach ($paketSoal as $paket) {
            $aksesGuru = $dataGuru->random(rand(1, $dataGuru->count()));

            foreach ($aksesGuru as $guru) {
                AksesPaketSoal::create([
                    'id_paket_soal' => $paket->id_paket_soal,
                    'id_guru'       => $guru->id_guru
                ]);
            }

            $soal = Soal::factory()->count($jumlahSoal)->create([
                'id_paket_soal' => $paket->id_paket_soal,
            ]);

            $soal->each(function ($s) use ($jumlahPilihan) {
                $jawaban = PilihanJawaban::factory()->count($jumlahPilihan)->create([
                    'id_soal' => $s->id_soal,
                    'benar' => false
                ]);
                $jawaban->random()->update(['benar' => true]);
            });
        }

        PaketUjian::factory()->count($jumlahPaketUji)->create()->each(function ($pu) use ($paketSoal) {
            Ujian::factory()->create([
                'id_paket_ujian' => $pu->id_paket_ujian,
                'id_paket_soal' => $paketSoal->random()->id_paket_soal
            ]);
        });

        $this->command->info("Seeding complete!");
    }
}
