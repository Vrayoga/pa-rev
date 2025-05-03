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
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekstrakurikuler',100);
            $table->string('Gambar')->nullable();
            $table->text('Deskripsi');
            $table->foreignId('id_kategori')->constrained('kategori')->onDelete('cascade');
            $table->string('Lokasi', 100);
            $table->foreignId('id_users')->constrained('users')->onDelete('cascade');
            $table->enum('Periode', ['Aktif', 'Tidak_aktif'])->default('aktif');
            $table->enum('jenis', ['wajib', 'pilihan'])->default('wajib');
            $table->integer('kuota')->nullable(); 
            $table->timestamps();

            
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler');
    }
};
