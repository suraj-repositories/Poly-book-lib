<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Services\FileService;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {

        $semesters = Semester::all();
        return view('admin.semester.semesters', compact('semesters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'sub_title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileService->uploadFile($request->file('image'), 'semesters', 'public');
        }

        Semester::create([
            'title' => $validated['title'],
            'sub_title' => $validated['sub_title'],
            'image' =>  $validated['image'] ?? null
        ]);

        return redirect()->back()->with('success', 'Semester Created Successfully!');
    }

    public function update(Semester $semester, Request $request){
        $validated = $request->validate([
            'title' => 'nullable|string',
            'sub_title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileService->uploadFile($request->file('image'), 'semesters', 'public');
            $this->fileService->deleteIfExists($semester->image);
        }

        $semester->title = $validated['title'];
        $semester->sub_title = $validated['sub_title'];
        $semester->image = $validated['image'] ?? $semester->image;
        $semester->save();

        return redirect()->back()->with('success', 'Semester Updated Successfully!');
    }

    public function destroy(Semester $semester){

        if (!$semester) {
            return abort('404', 'Branch Not Found!');
        }

        $this->fileService->deleteIfExists($semester->image);
        $semester->delete();

        return redirect()->back()->with('success', 'Semester Deleted Successfully!');

    }

}
