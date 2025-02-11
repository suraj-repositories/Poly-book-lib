<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //

    public function store(Book $book, Request $request)
    {
        $validated = $request->validate([
            'review' => 'required',
            'rating' => 'nullable|numeric|min:0|max:5'
        ]);

        $review = null;
        if (Review::where('user_id', Auth::id())->where('book_id', $book->id)->exists()) {
            $review = Review::where('user_id', Auth::id())->where('book_id', $book->id)->update([
                'review' => $validated['review'],
                'rating' => $validated['rating'] ?? 0
            ]);
        } else {
            $review = Review::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'review' => $validated['review'],
                'rating' => $validated['rating'] ?? 0
            ]);
        }


        return redirect()->back()->with(
            [
                'success' => 'Review Added Successfully!',
                'review_id' => $review->id ?? 0
            ]
        );
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review Removed Successfully!');
    }
}
