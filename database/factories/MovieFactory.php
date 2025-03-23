<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'age_rating' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R', 'NC-17']),
            'language' => $this->faker->randomElement(['English', 'Spanish', 'French', 'German', 'Chinese']),
            'cover_img_url' => $this->faker->imageUrl()
        ];
    }
}
