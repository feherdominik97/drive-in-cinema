<?php

namespace App\Models;

use Database\Factories\ScreeningFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Screening",
 *     required={"movie_id", "available_seats", "screening_time"},
 *     @OA\Property(property="movie_id", type="integer"),
 *     @OA\Property(property="available_seats", type="integer"),
 *     @OA\Property(property="screening_time", type="string", format="date-time")
 * )
 */
class Screening extends Model
{
    /** @use HasFactory<ScreeningFactory> */
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'available_seats',
        'screening_time'
    ];
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
