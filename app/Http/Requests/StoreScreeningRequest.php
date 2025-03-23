<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreScreeningRequest",
 *     required={"movie_id", "available_seats", "screening_time"},
 *     @OA\Property(property="movie_id", type="integer"),
 *     @OA\Property(property="available_seats", type="integer"),
 *     @OA\Property(property="screening_time", type="string", format="date-time")
 * )
 */
class StoreScreeningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'screening_time' => 'required|date|after:now',
            'available_seats' => 'required|integer|min:1',
            'movie_id' => 'required|exists:movies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'screening_time.required' => 'The screening time is required.',
            'screening_time.date' => 'The screening time must be a valid date.',
            'screening_time.after' => 'The screening time must be in the future.',
            'available_seats.required' => 'The number of available seats is required.',
            'available_seats.integer' => 'The available seats must be a valid integer.',
            'available_seats.min' => 'The available seats must be at least 1.',
            'movie_id.required' => 'The movie selection is required.',
            'movie_id.exists' => 'The selected movie does not exist.',
        ];
    }
}
