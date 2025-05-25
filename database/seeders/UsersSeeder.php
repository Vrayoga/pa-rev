<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // pastikan ini di-import

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'nis_nip' => '99999999',
        ])->assignRole('admin');

        User::create([
            'name' => 'sepak bola',
            'email' => 'bola@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'nis_nip' => '11111111',
        ])->assignRole('guru_pembina');

        User::create([
            'name' => 'voli',
            'email' => 'voli@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'nis_nip' => '22222222',
        ])->assignRole('guru_pembina');

        User::create([
            'name' => 'basket',
            'email' => 'basket@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'nis_nip' => '33333333',
        ])->assignRole('guru_pembina');

        User::create([
            'name' => 'pramuka',
            'email' => 'pramuka@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'nis_nip' => '44444444',
        ])->assignRole('guru_pembina');

        User::create([
            'name' => 'futsal',
            'email' => 'futsal@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('siswa123'),
            'nis_nip' => '00000000',
        ])->assignRole('guru_pembina');
    }
}
