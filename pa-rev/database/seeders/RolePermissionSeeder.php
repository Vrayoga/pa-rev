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
            'show ekstrakurikuler',
            'delete ekstrakurikuler',
            'show ekstra',

            'view logbook',
            'create logbook',
            'update logbook',
            'edit logbook',
            'delete logbook',

            'view jadwal',
            'create jadwal',
            'update jadwal',
            'edit jadwal',
            'delete jadwal',

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
            'validasi pendaftaran',

            'view absensi',
            'create absensi',
            'update absensi',
            'edit absensi',
            'delete absensi',
            'tutup absensi',

            'view role',
            'create role',
            'update role',
            'edit role',
            'delete role',

            'view permission',
            'create permission',
            'update permission',
            'edit permission',
            'delete permission',
            'manage permissions',
            'update permissions',


            'view sesi absensi',
            'open sesi absensi',
            'close sesi absensi',


            'view user',
            'create user',
            'update user',
            'delete user',
            'edit user',
            'update user',
            'delete user',

            'view sesiAbsen',
            'buka sesiAbsen',
            'tutup sesiAbsen',


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
            'edit ekstrakurikuler',
            'delete ekstrakurikuler',

            'view logbook',
            'delete logbook',
            
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

            'view permission',
            'create permission',
            'update permission',
            'edit permission',
            'delete permission',
            'manage permissions',
            'update permissions',

            'view pendaftaran',
            'validasi pendaftaran',




            'view user',
            'create user',
            'update user',
            'delete user',
            'edit user',
            'update user',
            'delete user',
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
            'create pendaftaran',
            'show ekstrakurikuler',

        ]);
    }
}
