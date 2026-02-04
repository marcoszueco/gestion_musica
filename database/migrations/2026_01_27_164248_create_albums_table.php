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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title');                // Título del álbum
            $table->string('artist');               // Nombre del artista o banda
            $table->year('release_year')->nullable(); // Año de lanzamiento
            $table->string('genre')->nullable();    // Género musical
            $table->string('label')->nullable();
            $table->integer('track_count')->default(0); // Número de pistas
            $table->integer('duration')->default(0);
            $table->string('cover_image')->nullable(); // Ruta de la imagen de portada
            $table->enum('format',['vinyl','cd','digital']);
            $table->integer('average_rating')->default(0);//Valoración media

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
