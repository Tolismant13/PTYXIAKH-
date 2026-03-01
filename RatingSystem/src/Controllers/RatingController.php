<?php

namespace RatingSystem\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RatingSystem\Models\Rating;

class RatingController extends Controller
{
	public function store(Request $request)
	{
		$request->validate([
			'rateable_id' => 'required',
			'rateable_type' => 'required',
			'rating' => 'required|integer|min:1|max:5'
		]);

		$rateableType = $request->rateable_type;
		$rateableId = $request->rateable_id;

		// Make sure the model exists
		if (!class_exists($rateableType)) {
			return back()->withErrors('Invalid model type.');
		}

		$rateable = $rateableType::find($rateableId);
		if (!$rateable) {
			return back()->withErrors('Item not found.');
		}

		// Save rating
		$rateable->ratings()->updateOrCreate(
			['user_id' => auth()->id()],
			['rating' => $request->rating, 'review' => $request->review]
		);

		return back()->with('success', 'Rating submitted successfully!');
	}

	public function average($rateableType, $rateableId)
	{
		$avg = Rating::where('rateable_id', $rateableId)
					 ->where('rateable_type', $rateableType)
					 ->avg('rating');

		return response()->json([
			'average' => round($avg, 1)
		]);
	}
}