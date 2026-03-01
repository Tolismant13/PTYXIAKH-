<?php
namespace RatingSystem\Traits;

use RatingSystem\Models\Rating;

trait HasRatings
{
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function userRating($userId)
    {
        return $this->ratings()->where('user_id', $userId)->first();
    }

    public function averageRating()
    {
        return round($this->ratings()->avg('rating'), 1);
    }
}