<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Branch;
use App\Models\File;
use App\Models\Semester;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('admin.books.show_books');
    }

    public function create()
    {

        $files  = File::latest()->take(10)->get();

        foreach ($files as $file) {
            $filePath = $file->file_path;
            $size = Storage::disk('public')->exists($filePath) ? $this->fileService->getSizeByPath($filePath) : '-';
            $file->size = $size;
            $file->icon = $this->fileService->getIconFromExtension($this->fileService->getExtensionByPath($filePath));
        }

        $branches = Branch::latest()->get();
        $semesters = Semester::get();

        return view('admin.books.add_book', compact('files', 'branches', 'semesters'));
    }

    public function store(BookRequest $request){

        if ($request->hasFile('image')) {
            $image = $this->fileService->uploadFile($request->image, "books", "public");
            $request['cover_image'] = $image;
        }

        $book = new Book();
        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->pages = $request['pages'];
        $book->price = $request['price'];
        $book->cover_image = $request['cover_image'];
        $book->branch_id = $request['branch_id'];
        $book->semester_id = $request['semester_id'];
        $book->file_id = $request['file_id'];
        $book->description = $request['description'];
        $book->save();

        if($book){
            return redirect()->back()->with('success', 'Book added Successfully!');
        }
        return redirect()->back()->with('error', 'Error while adding book!');
  }

    public function selectFromFiles(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $search = $request->search;

        $files = File::query()
            ->when($search, function ($query, $search) {
                $query->where('file_name', 'like', '%' . $search . '%');
                $query->orWhere('mime_type', 'like', '%' . $search . '%');
            })
            ->latest()->paginate($limit, ['*'], 'page', $page);

        foreach ($files as $file) {
            $filePath = $file->file_path;
            $size = Storage::disk('public')->exists($filePath) ? $this->fileService->getSizeByPath($filePath) : '-';
            $file->size = $size;
            $file->icon = $this->fileService->getIconFromExtension($this->fileService->getExtensionByPath($filePath));
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'data' => view('admin.books.partials.selectable_files', compact('files'))->render(),
            'has_more' => $files->hasMorePages(),
        ]);
    }


}
