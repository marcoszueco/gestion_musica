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
            // Clave foránea al usuario que califica
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Clave foránea al contenido (en este caso, 'albums')
            $table->foreignId('album_id')->constrained('albums')->onDelete('cascade');

            // Campo para la puntuación (ej: 1 a 5 (Tiny))
            $table->unsignedTinyInteger('score');

            //Restringe a una única valoración
            $table->unique(['user_id', 'album_id']);

            $table->timestamps();
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
