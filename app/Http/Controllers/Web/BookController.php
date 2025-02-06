<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Branch;
use App\Models\Semester;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function index()
    {
        $books = Book::paginate(12);
        return view('web.books.books', compact('books'));
    }

    public function show(Branch $branch, Semester $semester, Book $book)
    {
        return view('web.books.book', compact('branch', 'semester', 'book'));
    }
}
