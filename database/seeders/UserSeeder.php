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
        $dev = User::factory()->create([
            'name' => 'Desarrollador',
            'type' => 'admin',
            'email' => 'rosanyelismendoza@gmail.com',
            'password' => Hash::make('admin'),
            'status' => '1'
        ]);
        $dev->assignRole('Desarrollador');
        $user = User::factory()->create([
            'name' => 'Administrador',
            'type' => 'admin',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('admin'),
            'status' => '1'
        ]);
        $user->assignRole('Administrador');

    }
}
