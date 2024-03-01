<?php

namespace App\Http\Controllers\Api\V1;;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $review = new Review();
        $review->option = $request->option;
        $review->email = $request->email;
        $review->note = $request->note;
        $review->review = $request->review;
        $review->user_advice = $request->user_advice;
        $review->date = $request->date;
        $review->advice = $request->advice;
        $review->save();

        return response()->json($review, 201);
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        return response()->json($review);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json('Review deleted successfully', 200);
    }
}
