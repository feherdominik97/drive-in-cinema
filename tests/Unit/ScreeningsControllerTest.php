<?php


namespace Tests\Feature\API;

use App\Models\User;
use App\Models\Screening;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ScreeningsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to get a list of screenings with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_get_a_list_of_screenings()
    {
        $screening = Screening::factory()->create();

        $response = $this->getJson('/api/screenings');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $screening->id,
        ]);
    }

    /**
     * Test to create a new screening with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_create_a_new_screening()
    {
        $movie = Movie::factory()->create();
        $data = [
            'movie_id' => $movie->id,
            'available_seats' => 10,
            'screening_time' => '2025-03-24 10:00:00',
        ];

        $response = $this->postJson('/api/screenings', $data);

        $response->assertStatus(201);
        $response->assertJsonFragment($data);
    }

    /**
     * Test to get a screening by ID with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_get_a_screening_by_id()
    {
        $screening = Screening::factory()->create();

        $response = $this->getJson("/api/screenings/{$screening->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $screening->id,
        ]);
    }

    /**
     * Test to update a screening with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_update_a_screening()
    {
        $screening = Screening::factory()->create();
        $data = [
            'screening_time' => '2025-03-25 12:00:00',
        ];

        $response = $this->putJson("/api/screenings/{$screening->id}", $data);

        $response->assertStatus(200);
        $response->assertJsonFragment($data);
    }

    /**
     * Test to delete a screening with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_delete_a_screening()
    {
        $screening = Screening::factory()->create();

        $response = $this->deleteJson("/api/screenings/{$screening->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('screenings', [
            'id' => $screening->id,
        ]);
    }

    /**
     * Test to get the movie for a screening with Sanctum authentication.
     *
     * @return void
     */
    public function test_it_can_get_the_movie_for_a_screening()
    {
        $screening = Screening::factory()->create();
        $movie = Movie::factory()->create();
        $screening->movie()->associate($movie);
        $screening->save();

        $response = $this->getJson("/api/screenings/{$screening->id}/movie");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $movie->id,
        ]);
    }
}
