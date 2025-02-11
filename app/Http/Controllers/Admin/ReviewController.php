<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //

    public function index()
    {
        $reviews = Review::orderBy('id', 'desc')->get();
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Review::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.review.reviews', compact('reviews', 'last30days'));
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Review Removed Successfully!');
    }
}
