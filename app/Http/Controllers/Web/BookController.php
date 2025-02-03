<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function index(){
        $books = Book::paginate(12);
        return view('web.books.books', compact('books'));
    }
}
