<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cobertura de visibilidad
        $admin = Role::where('name', 'Admin')->first();

        $admin->givePermissionTo(Permission::where('module_key', 'seg')->get());
        $admin->givePermissionTo(Permission::where('module_key', 'cat')->get());
        $admin->givePermissionTo(Permission::where('module_key', 'menu')->get());
        $admin->givePermissionTo(Permission::where('module_key', 'priv')->get());
    }
}
