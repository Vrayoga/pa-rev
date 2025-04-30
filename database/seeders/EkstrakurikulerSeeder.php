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
                'nama_ekstrakurikuler' => 'Ekstra Wajib',
                'Gambar' => null,
                'Jadwal' => 'Senin, 15:00 - 17:00',
                'Deskripsi' => 'Kegiatan ekstrakurikuler wajib untuk semua siswa.',
                'id_kategori' => 1, // Adjust this ID based on your kategori table
                'Jam_mulai' => '15:00:00',
                'Jam_selesai' => '17:00:00',
                'Lokasi' => 'Aula Sekolah',
                'id_users' => 1, // Adjust this ID based on your users table
                'Periode' => 'Aktif',
                'jenis' => 'wajib',
                'stok' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_ekstrakurikuler' => 'Ekstra Pilihan',
                'Gambar' => null,
                'Jadwal' => 'Rabu, 14:00 - 16:00',
                'Deskripsi' => 'Kegiatan ekstrakurikuler pilihan untuk siswa.',
                'id_kategori' => 2, // Adjust this ID based on your kategori table
                'Jam_mulai' => '14:00:00',
                'Jam_selesai' => '16:00:00',
                'Lokasi' => 'Lapangan Sekolah',
                'id_users' => 2, // Adjust this ID based on your users table
                'Periode' => 'Aktif',
                'jenis' => 'pilihan',
                'stok' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
