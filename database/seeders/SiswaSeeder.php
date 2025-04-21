<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::create([
            'nama_siswa' => 'admin',
            'nis' => '237538776',
            'id_kelas' => 1,
            'sekolah_asal' => 'SMA Negeri 1',
            'tanggal_lahir' => '2000-01-01',
            'alamat' => 'Jl. Merdeka No. 1',
            'image' => null,
            'no_telepon' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Siswa::insert([
            [
                'nama_siswa' => 'Ahmad Fauzi',
                'nis' => '1234567890',
                'id_kelas' => 2,
                'sekolah_asal' => 'SMA Negeri 2',
                'tanggal_lahir' => '2001-02-15',
                'alamat' => 'Jl. Sudirman No. 2',
                'image' => null,
                'no_telepon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'AnandaMw',
                'nis' => '2202310054',
                'id_kelas' => 3,
                'sekolah_asal' => 'SMA Negeri 3',
                'tanggal_lahir' => '2002-03-20',
                'alamat' => 'Jl. Thamrin No. 3',
                'image' => null,
                'no_telepon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Citra Dewi',
                'nis' => '1234567892',
                'id_kelas' => 4,
                'sekolah_asal' => 'SMA Negeri 4',
                'tanggal_lahir' => '2003-04-25',
                'alamat' => 'Jl. Gatot Subroto No. 4',
                'image' => null,
                'no_telepon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Dian Pratama',
                'nis' => '1234567893',
                'id_kelas' => 5,
                'sekolah_asal' => 'SMA Negeri 5',
                'tanggal_lahir' => '2004-05-30',
                'alamat' => 'Jl. Ahmad Yani No. 5',
                'image' => null,
                'no_telepon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_siswa' => 'Eka Saputra',
                'nis' => '1234567894',
                'id_kelas' => 6,
                'sekolah_asal' => 'SMA Negeri 6',
                'tanggal_lahir' => '2005-06-10',
                'alamat' => 'Jl. Diponegoro No. 6',
                'image' => null,
                'no_telepon' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
