<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Hak Akses (Permissions)
        $permissions = [
            'view-dashboard',
            'manage-categories',
            'manage-items',
            'manage-mutations',
            'access-pos',
            'view-reports',
            'manage-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat Role & Pembagian Aksesnya
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $roleSuperAdmin->givePermissionTo(Permission::all());

        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleAdmin->givePermissionTo([
            'view-dashboard',
            'manage-categories',
            'manage-items',
            'manage-mutations',
            'access-pos',
            'view-reports',
        ]);

        $roleKasir = Role::firstOrCreate(['name' => 'Kasir']);
        $roleKasir->givePermissionTo([
            'view-dashboard',
            'access-pos',
        ]);
    }
}