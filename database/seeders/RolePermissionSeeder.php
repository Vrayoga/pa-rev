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
            'view roles',
            'create role',
            'update role',
            'delete role',
            'view permissions',
            'create permission',
            'update permission',
            'delete permission',
            'view kegiatan',
            'create kegiatan',
            'update kegiatan',
            'delete kegiatan',
            'view team',
            'create team',
            'update team',
            'delete team',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $guru = Role::firstOrCreate(['name' => 'guru']);
        $siswa = Role::firstOrCreate(['name' => 'siswa']);



        $admin->givePermissionTo([
             
            'view roles',
            'create role',
            'update role',
            'delete role',
            'view permissions',
            'create permission',
            'update permission',
            'delete permission',
            'view kegiatan',
            'create kegiatan',
            'update kegiatan',
            'delete kegiatan',
            'view team',
            'create team',
            'update team',
            'delete team',
        ]);
        $guru->givePermissionTo([
            'view dashboard',
            'view roles',
            'create role',
            'update role',
            'delete role',
            'view permissions',
            'create permission',
            'update permission',
            'delete permission',
            'view kegiatan',
            'create kegiatan',
            'update kegiatan',
            'delete kegiatan',
            'view team',
            'create team',
            'update team',
            'delete team',
        ]);
        $siswa->givePermissionTo([
            'view dashboard',
            'view roles',
            'create role',
            'update role',
            'delete role',
            'view permissions',
            'create permission',
            'update permission',
            'delete permission',
            'view kegiatan',
            'create kegiatan',
            'update kegiatan',
            'delete kegiatan',
            'view team',
            'create team',
            'update team',
            'delete team',
        ]);
    }
}
