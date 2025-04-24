<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view dashboard',
            'view siswa',
            'create siswa',
            'edit siswa',
            'update siswa',
            'delete siswa',

            'view kelas',
            'create kelas',
            'edit kelas',
            'update kelas',
            'delete kelas',

            'view kategori',
            'create kategori',
            'update kategori',
            'edit kategori',
            'delete kategori',

            'view ekstrakurikuler',
            'create ekstrakurikuler',
            'edit ekstrakurikuler',
            'update ekstrakurikuler',
            'delete ekstrakurikuler',

            'view logbook',
            'create logbook',
            'update logbook',
            'edit logbook',
            'delete logbook',

            'view prestasi',
            'create prestasi',
            'update prestasi',
            'edit prestasi',
            'delete prestasi',

            'view pendaftaran',
            'create pendaftaran',
            'update pendaftaran',
            'edit pendaftaran',
            'delete pendaftaran',

            'view absensi',
            'create absensi',
            'update absensi',
            'edit absensi',
            'delete absensi',

            'view role',
            'create role',
            'update role',
            'delete role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $guru = Role::firstOrCreate(['name' => 'guru']);
        $siswa = Role::firstOrCreate(['name' => 'siswa']);



        $admin->givePermissionTo([
            'view dashboard',

            'view siswa',
            'create siswa',
            'update siswa',
            'delete siswa',

            'view kelas',
            'create kelas',
            'update kelas',
            'delete kelas',
            
            'view kategori',
            'create kategori',
            'update kategori',
            'delete kategori',

            'view ekstrakurikuler',
            'create ekstrakurikuler',
            'update ekstrakurikuler',
            'delete ekstrakurikuler',

            'view logbook',
            
            'view prestasi',
            'create prestasi',
            'update prestasi',
            'delete prestasi',


            'view absensi',


            'view role',
            'create role',
            'update role',
            'edit role',
            'delete role',
        ]);
        $guru->givePermissionTo([
            'view dashboard',

            'view logbook',
            'create logbook',
            'update logbook',
            'edit logbook',
            'delete logbook',

            'view prestasi',
            'create prestasi',
            'update prestasi',
            'edit prestasi',
            'delete prestasi',

            'view absensi',
            'create absensi',
            'edit absensi',
            'update absensi',
            'delete absensi',

        ]);
        $siswa->givePermissionTo([
            'view dashboard',
            'view pendaftaran',

        ]);
    }
}
