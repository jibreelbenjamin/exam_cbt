<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mapel', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->text('nama');
            $table->timestamps();
        });

        Schema::create('soal', function (Blueprint $table) {
            $table->id('id_soal');
            $table->foreignId('id_mapel')->constrained('mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_guru')->constrained('guru', 'id_guru')->onDelete('cascade');
            $table->string('gambar')->nullable(); // simpan nama file atau path
            $table->text('pertanyaan');
            $table->enum('jenis', ['pilihan_ganda', 'essay']);
            $table->timestamps();
        });

        Schema::create('pilihan_jawaban', function (Blueprint $table) {
            $table->id('id_pilihan');
            $table->foreignId('id_soal')->constrained('soal', 'id_soal')->onDelete('cascade');
            $table->string('gambar')->nullable(); // simpan nama file atau path
            $table->text('jawaban');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });

        Schema::create('ujian', function (Blueprint $table) {
            $table->id('id_ujian');
            $table->foreignId('id_mapel')->constrained('mapel', 'id_mapel')->onDelete('cascade');
            $table->foreignId('id_admin')->constrained('admin', 'id_admin')->onDelete('cascade');
            $table->string('nama_ujian');
            $table->text('deskripsi')->nullable();
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_selesai');
            $table->integer('durasi_menit');
            $table->boolean('acak_soal')->default(false);
            $table->enum('status', ['aktif','nonaktif'])->default('nonaktif');
            $table->timestamps();
        });

        Schema::create('jawaban_siswa', function (Blueprint $table) {
            $table->id('id_jawaban_siswa');
            $table->foreignId('id_ujian')->constrained('ujian', 'id_ujian')->onDelete('cascade');
            $table->foreignId('id_siswa')->constrained('siswa', 'id_siswa')->onDelete('cascade');
            $table->foreignId('id_soal')->constrained('soal', 'id_soal')->onDelete('cascade');
            $table->text('jawaban')->nullable(); // Jawaban (ID pilihan untuk PG, teks untuk essay)
            $table->boolean('is_correct')->nullable(); // Hanya untuk PG
            $table->dateTime('waktu_selesai');
            $table->dateTime('waktu_jawab')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mapel');
        Schema::dropIfExists('soal');
        Schema::dropIfExists('pilihan_jawaban');
        Schema::dropIfExists('ujian');
        Schema::dropIfExists('jawaban_siswa');
    }
};
