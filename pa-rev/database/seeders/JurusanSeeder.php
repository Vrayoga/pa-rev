<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusan')->insert([
            ['nama_jurusan' => 'AKUNTANSI', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'TEKNIK KOMPUTER JARINGAN', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'PRODUKSI FILM', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'REKAYASA PERANGKAT LUNAK', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'BISNIS DIGITAL', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'MANAJEMEN PERKANTORAN', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'PERHOTELAN', 'created_at' => now(), 'updated_at' => now()],
            ['nama_jurusan' => 'DESAIN DAN PRODUKSI BUSANA', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    }
