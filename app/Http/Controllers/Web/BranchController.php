<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::paginate(10);
        return view('web.branches.branches', compact('branches'));
    }

    public function show(Branch $branch){
        return view('web.branches.branch', compact('branch'));
    }

    public function books(Branch $branch){
        $books = $branch->books()->paginate(9);
        return view('web.branches.branch', compact('branch', 'books'));
    }
}
