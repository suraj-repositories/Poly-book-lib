<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //

    public function index(){

        $semesters = Semester::all();
        return view('admin.semesters', compact('semesters'));
    }
}
