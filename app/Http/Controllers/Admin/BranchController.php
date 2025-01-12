<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Services\FileService;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    private $fileService;

    public function __construct(FileService $fileService) {
        $this->fileService = $fileService;
    }

    //
    public function index(){
        return view('admin.branches');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);

        if($request->file('image')){
            $image = $this->fileService->uploadFile($request->image, "branches", "public");
            $validated['image'] = $image;
        }

        $branch = new Branch();
        $branch->name = $validated['name'];
        $branch->image = $validated['image'];
        $branch->save();

        return redirect()->back()->with('success', 'Branch Created Successfully!');

    }

    public function edit(){


    }

    public function fetchBranches(){

    }

}
