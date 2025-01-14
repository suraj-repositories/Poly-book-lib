<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
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
        $branches = Branch::all();
        return view('admin.branches', compact('branches'));
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);


        $validated['image'] = $validated['image'] ?? null;

        if ($request->file('image')) {
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
        $branches = Branch::get();
        return BranchResource::collection($branches);
    }

    public function destroy(Branch $branch){
        if(!$branch){
            return abort('404', 'Branch Not Found!');
        }

        $this->fileService->deleteIfExists($branch->image);

        $branch->delete();
        return redirect()->back()->with('success', 'Branch Deleted Successfully!');
    }

    public function update(Branch $branch, Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);


        $validated['image'] = $branch->image ?? null;


        if ($request->file('image')) {

            $image = $this->fileService->uploadFile($request->image, "branches", "public");
            $validated['image'] = $image;
            $this->fileService->deleteIfExists($branch->image);
        }

        $branch->name = $validated['name'];
        $branch->image = $validated['image'];
        $branch->save();

        return redirect()->back()->with('success', 'Branch Updated Successfully!');


    }



}
