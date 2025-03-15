<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //
    private $fileService;
    private $userAgentService;

    public function __construct(FileService $fileService, UserAgentService $userAgentService)
    {
        $this->fileService = $fileService;
        $this->userAgentService = $userAgentService;
    }

    public function index()
    {
        $books = Book::whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('books')
                ->groupBy('title');
        })->paginate(12);

        return view('web.books.books', compact('books'));
    }

    public function show(Book $book)
    {
        $userReview = Review::where('user_id', Auth::id())->first();

        $reviews = Review::when($userReview, function ($query, $userReview) {
            $query->orderByRaw("CASE WHEN id = ? THEN 0 ELSE 1 END", [$userReview->id]);
        })->where('book_id', $book->id)->latest()->paginate(10);

        $bookReviewCount = Review::where('book_id', $book->id)->count();

        $bookRating = 4;
        $totalRatings = Review::where('book_id', $book->id)->sum('rating');

        if($bookReviewCount > 0){
            $bookRating = $totalRatings / $bookReviewCount;
        }
        return view('web.books.book', compact('book', 'reviews', 'bookRating', 'bookReviewCount'));
    }

}
