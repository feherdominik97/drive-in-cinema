<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UpdateMovieRequest",
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="age_rating", type="string", enum={"G", "PG", "PG-13", "R", "NC-17"}),
 *     @OA\Property(property="language", type="string", enum={"English", "Spanish", "French", "German", "Chinese", "Japanese", "Hindi", "Russian", "Arabic", "Italian"}),
 *     @OA\Property(property="cover_img_url", type="string")
 * )
 */
class UpdateMovieRequest extends FormRequest
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
            'title' => 'string|max:255',
            'description' => 'string',
            'age_rating' => 'in:G,PG,PG-13,R,NC-17',
            'language' => 'in:English,Spanish,French,German,Chinese,Japanese,Hindi,Russian,Arabic,Italian',
            'cover_img_url' => 'url',
        ];
    }

    public function messages(): array
    {
        return [
            'language.required' => 'Please select a language for the movie.',
            'cover_img_url.url' => 'The cover image URL must be a valid URL.',
        ];
    }
}
