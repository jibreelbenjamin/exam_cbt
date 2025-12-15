<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // keterangan siswa
        Schema::create('exam_ruangan', function (Blueprint $table) {
            $table->id('id_ruangan');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('exam_kelas', function(Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nama');
            $table->timestamps();
        });

        // manajemen pengguna
        Schema::create('exam_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('exam_guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('exam_peserta', function (Blueprint $table) {
            $table->id('id_peserta');
            $table->foreignId('id_kelas')->constrained('exam_kelas', 'id_kelas')->onDelete('cascade');
            $table->foreignId('id_ruangan')->nullable()->constrained('exam_ruangan', 'id_ruangan')->nullOnDelete();
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('password');
            $table->string('unhashed_password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // manajemen soal
        Schema::create('exam_paket_soal', function (Blueprint $table) {
            $table->id('id_paket_soal');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        Schema::create('exam_akses_paket_soal', function (Blueprint $table) {
            $table->id('id_akses_paket_soal');
            $table->foreignId('id_paket_soal')->constrained('exam_paket_soal', 'id_paket_soal')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('exam_guru', 'id_guru')->onDelete('cascade');
            $table->unique(['id_paket_soal', 'id_guru']);
            $table->timestamps();
        });

        Schema::create('exam_soal', function (Blueprint $table) {
            $table->id('id_soal');
            $table->foreignId('id_paket_soal')->constrained('exam_paket_soal', 'id_paket_soal')->onDelete('cascade');
            $table->text('teks_soal');
            $table->string('gambar')->nullable();
            $table->tinyInteger('tipe_jawaban')->comment('1=Pilihan ganda, 2=Essay');
            $table->timestamps();
        });

        Schema::create('exam_pilihan_jawaban', function (Blueprint $table) {
            $table->id('id_pilihan_jawaban');
            $table->foreignId('id_soal')->constrained('exam_soal', 'id_soal')->onDelete('cascade');
            $table->text('teks_jawaban');
            $table->string('gambar')->nullable();
            $table->boolean('benar')->default(false);
            $table->timestamps();
        });

        // manajemen ujian
        Schema::create('exam_paket_ujian', function (Blueprint $table) {
            $table->id('id_paket_ujian');
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('exam_ujian', function (Blueprint $table) {
            $table->id('id_ujian');
            $table->foreignId('id_paket_ujian')->nullable()->constrained('exam_paket_ujian', 'id_paket_ujian')->nullOnDelete();
            $table->foreignId('id_paket_soal')->constrained('exam_paket_soal', 'id_paket_soal')->onDelete('cascade');
            $table->string('nama');
            $table->boolean('token')->default(false)->comment('1=Menggunakan token, 0=Tanpa token');;
            $table->boolean('status')->default(false)->comment('1=Aktif, 0=Nonaktif');;
            $table->integer('durasi')->default(0)->comment('Satuan menit');;
            $table->boolean('acak_soal')->default(false)->comment('1=Soal diacak, 0=Soal tidak diacak');;
            $table->datetime('jadwal_mulai');
            $table->datetime('jadwal_selesai');
            $table->timestamps();
        });

        Schema::create('exam_token', function (Blueprint $table) {
            $table->id('id_token');
            $table->foreignId('id_admin')->constrained('exam_admin', 'id_admin')->onDelete('cascade');
            $table->foreignId('id_ujian')->constrained('exam_ujian', 'id_ujian')->onDelete('cascade');
            $table->string('token');
            $table->integer('durasi')->default(0)->comment('Satuan menit');
            $table->datetime('token_expired_at');
            $table->timestamps();
        });

        // manajemen jawaban siswa
        Schema::create('exam_jawaban_siswa', function (Blueprint $table) {
            $table->id('id_jawaban_siswa');
            $table->foreignId('id_peserta')->constrained('exam_peserta', 'id_peserta')->onDelete('cascade');
            $table->foreignId('id_ujian')->constrained('exam_ujian', 'id_ujian')->onDelete('cascade');
            $table->foreignId('id_soal')->constrained('exam_soal', 'id_soal')->onDelete('cascade');
            $table->foreignId('id_pilihan_jawaban')->constrained('exam_pilihan_jawaban', 'id_pilihan_jawaban')->onDelete('cascade');
            $table->text('jawaban_essay')->nullable();
            $table->boolean('benar')->default(false);
            $table->timestamps();
        });

        Schema::create('exam_hasil_ujian', function (Blueprint $table) {
            $table->id('id_hasil_ujian');
            $table->foreignId('id_peserta')->constrained('exam_peserta', 'id_peserta')->onDelete('cascade');
            $table->foreignId('id_ujian')->constrained('exam_ujian', 'id_ujian')->onDelete('cascade');
            $table->integer('jumlah_benar')->default(0);
            $table->integer('jumlah_salah')->default(0);
            $table->float('nilai')->default(0);
            $table->integer('waktu_mengerjakan')->nullable();
            $table->datetime('mulai_mengerjakan');
            $table->datetime('selesai_mengerjakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_jawaban_siswa');
        Schema::dropIfExists('exam_sessions');
        Schema::dropIfExists('exam_hasil_ujian');
        Schema::dropIfExists('exam_ujian');
        Schema::dropIfExists('exam_pilihan_jawaban');
        Schema::dropIfExists('exam_soal');
        Schema::dropIfExists('exam_akses_paket_soal');
        Schema::dropIfExists('exam_paket_soal');
        Schema::dropIfExists('exam_paket_ujian');
        Schema::dropIfExists('exam_peserta');
        Schema::dropIfExists('exam_guru');
        Schema::dropIfExists('exam_admin');
        Schema::dropIfExists('exam_kelas');
        Schema::dropIfExists('exam_ruangan');
    }
};
