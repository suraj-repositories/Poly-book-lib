<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Branch;
use App\Models\BranchSemester;
use App\Models\Semester;
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

    public function semesterBooks(Branch $branch, Semester $semester){

        $branchSemester = BranchSemester::where('branch_id', $branch->id)->where('semester_id', $semester->id)->first();
        $books = $branchSemester->books()->paginate(12);
        return view('web.semesters.semester_books', compact('branch', 'semester', 'books'));
    }

    public function showBook(Branch $branch = null, Semester $semester = null, Book $book)
    {
        if ($branch || $semester) {
            if ($branch && $semester) {
                $branchSemester = BranchSemester::where('branch_id', $branch->id)->where('semester_id', $semester->id)->first();
                if (!$branchSemester) {
                    abort(404, "Branch Or Semester Not Found!");
                }
            } else {
                abort(404, 'Invalid semester or branch given!');
            }
        }


        return view('web.books.book', compact('book'));
    }


}
