<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 100)->unique();
            $table->string('nama_siswa', 100);
            $table->string('email', 100);
            $table->string('tempat', 10);
            $table->date('tanggal_lahir');
            $table->string('kelas', 30);
            $table->enum('jenis_kelamin',['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'kristen', 'katolik','hindu', 'buddha', 'konghucu']);
            $table->string('no_telepon', 20);
            $table->string('tahun_masuk', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
