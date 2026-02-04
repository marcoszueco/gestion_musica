<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 2. Crear el administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Crear 3 usuarios normales
        User::create([
            'name' => 'Juan Melómano',
            'email' => 'juan@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Maria Rock',
            'email' => 'maria@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Pedro Jazz',
            'email' => 'pedro@test.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
