<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Services\FileService;
use App\Services\UserAgentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    //
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function serve($type, $id, $filepath, Request $request)
    {

        $modelClass = $this->getModelClass($type);
        if (!$modelClass) return abort(404);

        $item = $modelClass::findOrFail($id);

        if (!isset($item->file) || !$this->fileService->fileExists($item->file->file_path, 'private')) {
            abort(404, 'Resource Not Available!');
        }

        $isPurchased = false;
        if (Auth::check()) {
            $user = User::find(Auth::id());
            $isPurchased = $user->isPurchased($type, $id);
        }

        if ($item->price <= 0 || $isPurchased) {
            return response()->file(storage_path("app/private/{$filepath}"));
        }

        return redirect()->back()->with('warning', 'Buy this book to get preview!');
    }

    private function getModelClass($type)
    {
        return match ($type) {
            'book' => Book::class,
            default => null,
        };
    }
}
