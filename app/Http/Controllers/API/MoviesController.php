<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(name="Movies", description="Operations related to movies")
 */
class MoviesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/movies",
     *     summary="Get a list of movies",
     *     tags={"Movies"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of movies",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Movie"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $movies = Movie::all();

        return response()->json($movies);
    }

    /**
     * @OA\Post(
     *     path="/api/movies",
     *     summary="Create a new movie",
     *     tags={"Movies"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StoreMovieRequest"))
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie created",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(StoreMovieRequest $request): JsonResponse
    {
        $movie = Movie::query()->create($request->validated());

        return response()->json($movie, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/movies/{id}",
     *     summary="Get a movie by ID",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single movie",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function show(Movie $movie): JsonResponse
    {
        return response()->json($movie);
    }

    /**
     * @OA\Put(
     *     path="/api/movies/{id}",
     *     summary="Update an existing movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateMovieRequest"))
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie updated",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        $movie->update($request->validated());

        return response()->json($movie);
    }

    /**
     * @OA\Delete(
     *     path="/api/movies/{id}",
     *     summary="Delete a movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Movie deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/movies/{id}/screenings",
     *     summary="Get all screenings for a movie",
     *     tags={"Movies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A list of screenings",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Screening"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found"
     *     )
     * )
     */
    public function screenings(Movie $movie): JsonResponse
    {
        $screenings = $movie->screenings;
        return response()->json($screenings);
    }
}
