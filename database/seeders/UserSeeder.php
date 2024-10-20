<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'rol_id' => 1,
            'name' => 'Desarrollador',
            'email' => 'rosanyelismendoza@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory()->create([
            'rol_id' => 1,
            'name' => 'Administrador',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
