<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\SiswaSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // $this->call([
        //     RolePermissionSeeder::class,
        // ]);
        $this->call([
            RolePermissionSeeder::class,

            KelasSeeder::class,
            SiswaSeeder::class,
            UsersSeeder::class,
            KategoriSeeder::class,
        ]);




        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'nis' => '99999999',
        ])->assignRole('admin');

        User::create([
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'nis' => '11111111',
        ])->assignRole('guru');
        User::create([
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('siswa123'),
            'nis' => '00000000',
        ])->assignRole('siswa');
    }
}
