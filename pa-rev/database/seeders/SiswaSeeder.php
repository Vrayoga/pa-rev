<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $kelas = ['X TKJ 1', 'X TKJ 2', 'XI TKJ 1', 'XI TKJ 2', 'XII TKJ 1', 'XII TKJ 2'];
        $agamaList = ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'];

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'nama_siswa' => 'Siswa ' . $i,
                'nisn' => 'NISN' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => 'siswa' . $i . '@example.com',
                'tempat' => 'Kota ' . $i,
                'tanggal_lahir' => now()->subYears(rand(15, 18))->subDays(rand(0, 365))->format('Y-m-d'),
                'kelas' => $kelas[array_rand($kelas)],
                'jenis_kelamin' => rand(0, 1) ? 'laki-laki' : 'perempuan',
                'agama' => $agamaList[array_rand($agamaList)],
                'no_telepon' => '0812' . rand(10000000, 99999999),
                'tahun_masuk' => '20' . rand(18, 23),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Siswa::insert($data);
    }
}
