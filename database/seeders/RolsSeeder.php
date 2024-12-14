<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Desarrollador']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Empresa']);
        Role::create(['name' => 'Proveedor']);
        Role::create(['name' => 'Empresa-Prueba']);
        Role::create(['name' => 'Proveedor-Prueba']);
        Role::create(['name' => 'Empresa-Operador']);
        Role::create(['name' => 'Proveedor-Operador']);

        
    }
}
