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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa', 100);
            $table->foreignId('id_kelas')->constrained('kelas')->onDelete('cascade');
            $table->string('sekolah_asal', 100);
            $table->string('tanggal_lahir', 10)->nullable();
            $table->string('alamat', 50)->nullable();
            $table->string('nis', 20)->unique();
            $table->string('image', 20)->nullable();
            $table->string('no_telepon', 20)->nullable();
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
