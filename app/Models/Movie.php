<?php

namespace App\Models;

use Database\Factories\MovieFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Movie",
 *     type="object",
 *     required={"title", "description", "age_rating", "language", "cover_img_url"},
 *     @OA\Property(property="id", type="integer", description="Movie ID"),
 *     @OA\Property(property="title", type="string", description="Title of the movie"),
 *     @OA\Property(property="description", type="string", description="Description of the movie"),
 *     @OA\Property(property="age_rating", type="string", description="Movie age rating"),
 *     @OA\Property(property="language", type="string", description="Language of the movie"),
 *     @OA\Property(property="cover_img_url", type="string", description="URL of the movie cover image")
 * )
 */
class Movie extends Model
{
    /** @use HasFactory<MovieFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'age_rating',
        'language',
        'cover_img_url'
    ];

    public function screenings(): HasMany
    {
        return $this->hasMany(Screening::class);
    }
}
