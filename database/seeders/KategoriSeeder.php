<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            ['nama_kategori' => 'Olahraga', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Ilmiah dan Akademik', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kepemimpinan dan Bela Negara', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
