<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FrequentlyAskedQuestion;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    //
    public function index(){
        $faqs = Faq::all()->groupBy('category');
        return view('admin.help.help', compact('faqs'));
    }
}
