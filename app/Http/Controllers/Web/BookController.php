<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookDownload;
use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    //
    private $fileService;
    private $userAgentService;

    public function __construct(FileService $fileService, UserAgentService $userAgentService)
    {
        $this->fileService = $fileService;
        $this->userAgentService = $userAgentService;
    }

    public function index()
    {
        $books = Book::paginate(12);
        return view('web.books.books', compact('books'));
    }

    public function show(Book $book)
    {
        return view('web.books.book', compact('book'));
    }

    public function downloadBook(Book $book, Request $request)
    {

        if (!isset($book->file) || !$this->fileService->fileExists($book->file->file_path)) {
            abort(404, 'Book Not Available!');
        }

        $ip = $request->ip();
        $userAgent = $request->header('User-Agent');

        $deviceType = $this->userAgentService->detectDevice($userAgent);
        $browser = $this->userAgentService->detectBrowser($userAgent);
        $os = $this->userAgentService->detectOS($userAgent);
        $location = $this->userAgentService->getLocationFromIP($ip);

        BookDownload::create([
            'book_id' => $book->id,
            'user_id' => Auth::id(),
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'device_type' => $deviceType,
            'browser' => $browser,
            'os' => $os,
            'location' => $location
        ]);

        return response()->download(storage_path("app/public/{$book->file->file_path}"));
    }
}
