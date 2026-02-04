<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'artist' => fake()->name(),
            'release_year' => fake()->numberBetween(1960, 2024),
            'genre' => fake()->randomElement(['Rock', 'Jazz', 'Pop', 'Electronic', 'Hip-Hop', 'Blues']),
            'label' => fake()->company(),
            'track_count' => fake()->numberBetween(5, 18),
            'duration' => fake()->numberBetween(1800, 5400), // En segundos
            'cover_image' => 'https://picsum.photos/seed/' . fake()->uuid . '/500/500', // Imagen aleatoria
            'format' => fake()->randomElement(['vinyl', 'cd', 'digital']),
            'average_rating' => fake()->numberBetween(1, 5),
            // 5. Asignar usuario aleatorio (asume que ya hay usuarios)
            'user_id' => \App\Models\User::all()->random()->id ?? \App\Models\User::factory(),
        ];
    }
}
