<?php

use RatingSystem\Models\Rating;

if (!function_exists('average_rating')) {
    function average_rating($product)
    {
		$avg = Rating::where('rateable_id', $product->id)
					 ->where('rateable_type', get_class($product))
					 ->avg('rating');
        return round($avg, 1);
    }
}

if (!function_exists('ratings_count')) {
    function ratings_count($product)
    {
        return Rating::where('rateable_id', $product->id)
                     ->where('rateable_type', get_class($product))
                     ->count();
    }
}