<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){



        return view('web.index');
    }
}
