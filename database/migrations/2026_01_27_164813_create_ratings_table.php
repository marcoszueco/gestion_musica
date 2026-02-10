<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            // Relaciones con claves foráneas
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('album_id')->constrained()->onDelete('cascade');

            // Tarea 5: El score como entero pequeño
            $table->unsignedTinyInteger('score'); // Guardará valores de 1 a 5

            $table->timestamps();

            // Evitar que un usuario vote dos veces el mismo álbum
            $table->unique(['user_id', 'album_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
