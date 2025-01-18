<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //

    public function index(){
        return view('admin.books.show_books');
    }

    public function create(){
        return view('admin.books.add_book');
    }

}
