<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ekstrakurikuler')->insert([
            [
            'nama_ekstrakurikuler' => 'Basket',
            'gambar' => 'dummy_ekstra\basket.jpg',
            'deskripsi' => 'Kegiatan ekstrakurikuler basket untuk siswa.',
            'id_kategori' => 1, 
            'lokasi' => 'Lapangan Basket',
            'id_users' => 4, 
            'periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 20,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Voli',
            'gambar' => 'dummy_ekstra\voli.jpg',
            'deskripsi' => 'Kegiatan ekstrakurikuler voli untuk siswa.',
            'id_kategori' => 1, 
            'lokasi' => 'Lapangan Voli',
            'id_users' => 3, 
            'periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 15,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Pramuka',
            'gambar' => 'dummy_ekstra\pramuka.jpeg',
            'deskripsi' => 'Kegiatan ekstrakurikuler pramuka untuk siswa.',
            'id_kategori' => 3, 
            'lokasi' => 'Halaman Sekolah',
            'id_users' => 4, 
            'periode' => 'Aktif',
            'jenis' => 'wajib',
            'kuota' => 30,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Futsal',
            'gambar' => 'dummy_ekstra\futsal.png',
            'deskripsi' => 'Kegiatan ekstrakurikuler futsal untuk siswa.',
            'id_kategori' => 1, 
            'lokasi' => 'Lapangan Futsal',
            'id_users' => 5, 
            'periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 25,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Sepak Bola',
            'gambar' => 'dummy_ekstra\sepak-bola.png',
            'deskripsi' => 'Kegiatan ekstrakurikuler sepak bola untuk siswa.',
            'id_kategori' => 1, 
            'lokasi' => 'Lapangan Sepak Bola',
            'id_users' => 1, 
            'periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 22,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
