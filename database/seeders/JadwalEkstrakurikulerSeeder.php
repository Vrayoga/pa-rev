<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalEkstrakurikulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_ekstrakurikuler')->insert([
            [
                'ekstrakurikuler_id' => 1,
                'hari' => 'senin',
                'jam_mulai' => '14:00:00',
                'jam_selesai' => '16:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekstrakurikuler_id' => 2,
                'hari' => 'selasa',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekstrakurikuler_id' => 3,
                'hari' => 'selasa',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekstrakurikuler_id' => 4,
                'hari' => 'kamis',
                'jam_mulai' => '14:30:00',
                'jam_selesai' => '16:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ekstrakurikuler_id' => 5,
                'hari' => 'jumat',
                'jam_mulai' => '16:00:00',
                'jam_selesai' => '18:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
