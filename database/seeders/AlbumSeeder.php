<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primero nos aseguramos de que existan usuarios para asignar
        if (\App\Models\User::count() === 0) {
            \App\Models\User::factory(5)->create();
        }

        // 4. Generar 30 ítems (superamos los 20 para ver la paginación de 15 en acción)
        Album::factory(30)->create();
    }
}
