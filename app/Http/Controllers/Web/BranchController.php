<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Semester;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //
    public function index(){
        $branches = Branch::paginate(12);
        return view('web.branches.branches', compact('branches'));
    }

    public function show($param){

        return view('web.branches.branch2');
    }

    public function wwe(){

        return view('web.branches.branch');
    }

}
