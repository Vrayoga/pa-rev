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
        $jurusan = [
            'REKAYASA PERANGKAT LUNAK',
            'TEKNIK KOMPUTER JARINGAN',
            'AKUNTANSI',
            'PRODUKSI FILM',
            'BISNIS DIGITAL',
            'MANAJEMEN PERKANTORAN',
            'DESAIN DAN PRODUKSI BUSANA',
            'PERHOTELAN'
        ];

        $data = [];
        $tingkat = ['X', 'XI', 'XII'];

        foreach ($tingkat as $t) {
            foreach ($jurusan as $index => $j) {
                if ($index + 1 > 2) {
                    continue; // Only include kode_kelas 1 and 2
                }
                $data[] = [
                    'tingkat' => $t,
                    'id_jurusan' => $index + 1, // Assuming jurusan IDs start from 1
                    'kode_kelas' => $t . '-' . ($index + 1),
                    'id_users' => null
                ];
            }
        }

        DB::table('kelas')->insert($data);
    }
    }

