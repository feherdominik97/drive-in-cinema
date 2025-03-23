<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreMovieRequest",
 *     type="object",
 *     required={"title", "description", "age_rating", "language", "cover_img_url"},
 *     @OA\Property(property="title", type="string", example="The Dark Knight"),
 *     @OA\Property(property="description", type="string", example="A dark and gritty superhero film."),
 *     @OA\Property(property="age_rating", type="string", enum={"G", "PG", "PG-13", "R", "NC-17"}, example="PG-13"),
 *     @OA\Property(property="language", type="string", enum={"English", "Spanish", "French", "German", "Chinese", "Japanese", "Hindi", "Russian", "Arabic", "Italian"}, example="English"),
 *     @OA\Property(property="cover_img_url", type="string", example="http://example.com/cover.jpg")
 * )
 */
class StoreMovieRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'age_rating' => 'required|in:G,PG,PG-13,R,NC-17',
            'language' => 'required|in:English,Spanish,French,German,Chinese,Japanese,Hindi,Russian,Arabic,Italian',
            'cover_img_url' => 'required|url',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The movie title is required.',
            'description.required' => 'The movie description is required.',
            'age_rating.required' => 'Please select a valid age rating for the movie.',
            'language.required' => 'Please select a language for the movie.',
            'cover_img_url.required' => 'The cover image URL is required.',
            'cover_img_url.url' => 'The cover image URL must be a valid URL.',
        ];
    }
}
