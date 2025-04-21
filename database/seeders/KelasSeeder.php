<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kelas' => 'X', 'jurusan' => 'Teknik Informatika'],
            ['kelas' => 'X', 'jurusan' => 'Teknik Mesin'],
            ['kelas' => 'XI', 'jurusan' => 'Teknik Informatika'],
            ['kelas' => 'XI', 'jurusan' => 'Teknik Mesin'],
            ['kelas' => 'XII', 'jurusan' => 'Teknik Informatika'],
            ['kelas' => 'XII', 'jurusan' => 'Teknik Mesin'],
        ];

        DB::table('kelas')->insert($data);
    }
}
