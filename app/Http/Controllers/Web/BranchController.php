<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //
    public function index(){
        $branches = Branch::paginate(12);
        return view('web.branches.branches', compact('branches'));
    }
}
