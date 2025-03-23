<?php

namespace Tests\Unit;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MoviesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method with authentication.
     *
     * @return void
     */
    public function test_index_authenticated()
    {
        $movie = Movie::factory()->create();

        $response = $this->getJson('/api/movies');

        $response->assertStatus(200)
            ->assertJson([['id' => $movie->id]]);
    }

    /**
     * Test store method with authentication.
     *
     * @return void
     */
    public function test_store_authenticated()
    {
        $data = [
            'title' => 'Test Movie',
            'description' => 'Test description',
            'age_rating' => 'PG-13',
            'language' => 'English',
            'cover_img_url' => 'https://example.com/cover.jpg',
        ];

        $response = $this->postJson('/api/movies', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Movie']);
    }

    /**
     * Test show method with authentication.
     *
     * @return void
     */
    public function test_show_authenticated()
    {
        $movie = Movie::factory()->create();

        $response = $this->get("/api/movies/{$movie->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $movie->id]);
    }

    /**
     * Test update method with authentication.
     *
     * @return void
     */
    public function test_update_authenticated()
    {
        $movie = Movie::factory()->create();

        $data = [
            'title' => 'Updated Movie',
            'description' => 'Updated description',
            'age_rating' => 'R',
            'language' => 'Spanish',
            'cover_img_url' => 'https://example.com/updated_cover.jpg',
        ];

        $response = $this->putJson("/api/movies/{$movie->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Movie']);
    }

    /**
     * Test destroy method with authentication.
     *
     * @return void
     */
    public function test_destroy_authenticated()
    {
        $movie = Movie::factory()->create();

        $response = $this->deleteJson("/api/movies/{$movie->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }

    /**
     * Test screenings method with authentication.
     *
     * @return void
     */
    public function test_screenings_authenticated()
    {
        $movie = Movie::factory()->create();
        $movie->screenings()->create([
            'available_seats' => 100,
            'screening_time' => now()->addDay(),
        ]);

        $response = $this->getJson("/api/movies/{$movie->id}/screenings");

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }
}
