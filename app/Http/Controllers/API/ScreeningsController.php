<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreScreeningRequest;
use App\Http\Requests\UpdateScreeningRequest;
use App\Models\Screening;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(name="Screenings", description="Operations related to screenings")
 */
class ScreeningsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/screenings",
     *     summary="Get a list of screenings",
     *     tags={"Screenings"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of screenings",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Screening"))
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $screenings = Screening::all();

        return response()->json($screenings);
    }

    /**
     * @OA\Post(
     *     path="/api/screenings",
     *     summary="Create a new screening",
     *     tags={"Screenings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StoreScreeningRequest"))
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Screening created",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(StoreScreeningRequest $request): JsonResponse
    {
        $screening = Screening::query()->create($request->validated());

        return response()->json($screening, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/screenings/{id}",
     *     summary="Get a screening by ID",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single screening",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     )
     * )
     */
    public function show(Screening $screening): JsonResponse
    {
        return response()->json($screening);
    }

    /**
     * @OA\Put(
     *     path="/api/screenings/{id}",
     *     summary="Update an existing screening",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/UpdateScreeningRequest"))
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Screening updated",
     *         @OA\JsonContent(ref="#/components/schemas/Screening")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(UpdateScreeningRequest $request, Screening $screening): JsonResponse
    {
        $screening->update($request->validated());

        return response()->json($screening);
    }

    /**
     * @OA\Delete(
     *     path="/api/screenings/{id}",
     *     summary="Delete a screening",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Screening deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     )
     * )
     */
    public function destroy(Screening $screening): JsonResponse
    {
        $screening->delete();

        return response()->json(null, 204);
    }

    /**
     * @OA\Get(
     *     path="/api/screenings/{id}/movie",
     *     summary="Get the movie for a screening",
     *     tags={"Screenings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie of the screening",
     *         @OA\JsonContent(ref="#/components/schemas/Movie")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Screening not found"
     *     )
     * )
     */
    public function movie(Screening $screening): JsonResponse
    {
        return response()->json($screening->movie);
    }
}
