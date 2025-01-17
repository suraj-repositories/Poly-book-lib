<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Models\Semester;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BranchController extends Controller
{

    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    //
    public function index()
    {


        $branches = Branch::all();
        $semesters = Semester::take(100)->get();

        return view('admin.branches', compact('branches', 'semesters'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'semester_id' => 'nullable|exists:semesters,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileService->uploadFile($request->file('image'), "branches", "public");
        }

        $branch = Branch::create([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
        ]);

        if ($validated['semester_id']) {
            $semesters = Semester::where('id', '<=', $validated['semester_id'])->pluck('id');

            if ($semesters->isEmpty()) {
                return redirect()->back()->with('error', 'Invalid Semester Choice!');
            }

            $branch->semesters()->attach($semesters, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return redirect()->back()->with('success', 'Branch Created Successfully!');
    }


    public function edit() {}

    public function fetchBranches()
    {
        $branches = Branch::get();
        return BranchResource::collection($branches);
    }

    public function destroy(Branch $branch)
    {
        if (!$branch) {
            return abort('404', 'Branch Not Found!');
        }

        $this->fileService->deleteIfExists($branch->image);

        $branch->delete();
        return redirect()->back()->with('success', 'Branch Deleted Successfully!');
    }

    public function update(Branch $branch, Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'semester_id' => 'nullable|exists:semesters,id',
        ]);


        $validated['image'] = $branch->image ?? null;


        if ($request->hasFile('image')) {

            $image = $this->fileService->uploadFile($request->image, "branches", "public");
            $validated['image'] = $image;
            $this->fileService->deleteIfExists($branch->image);
        }

        $branch->name = $validated['name'];
        $branch->image = $validated['image'];
        $branch->save();

        if (isset($validated['semester_id'])) {

            $selectedSemesterIndex = $validated['semester_id'];
            $semestersToKeep = Semester::where('id', '<=', $selectedSemesterIndex)->pluck('id');

            $currentSemesters = $branch->semesters()->pluck('semesters.id');

            $semestersToAdd = $semestersToKeep->diff($currentSemesters);
            $semestersToRemove = $currentSemesters->diff($semestersToKeep);

            if ($semestersToRemove->isNotEmpty()) {
                $branch->semesters()->detach($semestersToRemove);
            }

            if ($semestersToAdd->isNotEmpty()) {
                $branch->semesters()->attach($semestersToAdd, [
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->back()->with('success', 'Branch Updated Successfully!');
    }
}
