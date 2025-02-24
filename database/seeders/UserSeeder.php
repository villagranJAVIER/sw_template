<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'              => 'Administrador',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('12345678'),
                'email_verified_at' => now(),
                'created_at'        => now()
            ],
        ]);
        // Roles del sistema
        $admin = Role::create(['name' => 'Admin', 'description' => 'Administrador']);

        User::find(1)->assignRole($admin);
    }
}
