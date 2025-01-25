<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function index(){


        return view('admin.books.show_books');
    }

    public function create(){

        $files  = File::latest()->get();

        foreach ($files as $file) {
            $filePath = $file->file_path;
            $size = Storage::disk('public')->exists($filePath) ? $this->fileService->getSizeByPath($filePath) : '-';
            $file->size = $size;
            $file->icon = $this->fileService->getIconFromExtension($this->fileService->getExtensionByPath($filePath));
        }

        $branches = Branch::latest()->get();
        $semesters = Semester::latest()->get();

        return view('admin.books.add_book', compact('files', 'branches', 'semesters'));
    }

}
