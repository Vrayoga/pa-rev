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
            'Gambar' => 'dummy_ekstra\basket.jpg',
            'Deskripsi' => 'Kegiatan ekstrakurikuler basket untuk siswa.',
            'id_kategori' => 1, 
            'Lokasi' => 'Lapangan Basket',
            'id_users' => 4, 
            'Periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 20,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Voli',
            'Gambar' => 'dummy_ekstra\voli.jpg',
            'Deskripsi' => 'Kegiatan ekstrakurikuler voli untuk siswa.',
            'id_kategori' => 1, 
            'Lokasi' => 'Lapangan Voli',
            'id_users' => 3, 
            'Periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 15,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Pramuka',
            'Gambar' => 'dummy_ekstra\pramuka.jpeg',
            'Deskripsi' => 'Kegiatan ekstrakurikuler pramuka untuk siswa.',
            'id_kategori' => 3, 
            'Lokasi' => 'Halaman Sekolah',
            'id_users' => 4, 
            'Periode' => 'Aktif',
            'jenis' => 'wajib',
            'kuota' => 30,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Futsal',
            'Gambar' => 'dummy_ekstra\futsal.png',
            'Deskripsi' => 'Kegiatan ekstrakurikuler futsal untuk siswa.',
            'id_kategori' => 1, 
            'Lokasi' => 'Lapangan Futsal',
            'id_users' => 5, 
            'Periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 25,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nama_ekstrakurikuler' => 'Sepak Bola',
            'Gambar' => 'dummy_ekstra\sepak-bola.png',
            'Deskripsi' => 'Kegiatan ekstrakurikuler sepak bola untuk siswa.',
            'id_kategori' => 1, 
            'Lokasi' => 'Lapangan Sepak Bola',
            'id_users' => 1, 
            'Periode' => 'Aktif',
            'jenis' => 'pilihan',
            'kuota' => 22,
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
