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
            UsersSeeder::class,
            JurusanSeeder::class,
            KelasSeeder::class,
            SiswaSeeder::class,
            KategoriSeeder::class,
            EkstrakurikulerSeeder::class,
            JadwalEkstrakurikulerSeeder::class,
        ]);




    }
}
