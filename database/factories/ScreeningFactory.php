<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Screening>
 */
class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'screening_time' => $this->faker->dateTime,
            'available_seats' => $this->faker->numberBetween(0, 500),
            'movie_id' => Movie::factory(),
        ];
    }
}
