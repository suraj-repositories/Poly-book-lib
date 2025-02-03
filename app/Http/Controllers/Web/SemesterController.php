<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //
    public function index(Semester $semester){

        return view('web.branches.branch2');
    }

}
