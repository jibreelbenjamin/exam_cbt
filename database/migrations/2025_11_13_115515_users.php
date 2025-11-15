<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username')->unique();
            $table->string('nama');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('password');
            $table->json('akses_paket_soal')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->foreignId('id_kelas')->constrained('kelas', 'id_kelas')->onDelete('cascade');
            $table->foreignId('id_ruangan')->constrained('ruangan', 'id_ruangan')->onDelete('cascade');
            $table->string('nis')->unique();
            $table->string('nama');
            $table->string('password');
            $table->string('unhashed_password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('sessions');
    }
};
