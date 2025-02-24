<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            [
                'name' => 'Módulo de seguridad',
                'description' => 'Módulos de seguridad',
                'key' => 'seg',
                'audit_user_id' => 1,
                'created_at' => date('Y-m-d H:m:s')
            ],
            [
                'name' => 'Módulo de catálogos',
                'description' => 'Módulo de catálogos(SOLO ADMIN)',
                'key' => 'cat',
                'audit_user_id' => 1,
                'created_at' => date('Y-m-d H:m:s')
            ],
            [
                'name' => 'Menú',
                'description' => 'Control de acceso del menú',
                'key' => 'menu',
                'audit_user_id' => 1,
                'created_at' => date('Y-m-d H:m:s')
            ],
            [
                'name' => 'Módulos privado',
                'description' => 'Acceso solo para el admin',
                'key' => 'priv',
                'audit_user_id' => 1,
                'created_at' => date('Y-m-d H:m:s')
            ],
        ]);
    }
}
