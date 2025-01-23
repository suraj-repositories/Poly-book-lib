<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function create()
    {
        return view('admin.files.upload_file');
    }

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:png,jpg,pdf,word,odt,xls,xlsx|max:2048'
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $mimeType = $file->getClientMimeType();
        $filePath = $this->fileService->uploadFile($request->file('file'), "files", 'public');

        File::create([
            'file_path' =>  $filePath,
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'fileable_id' => null,
            'fileable_type' => null
        ]);

        return redirect()->back()->with('success', 'File Uploaded Successfully!');
    }

    public function uploadStatus(Request $request)
    {
        $fileName = $request->query('fileName');
        if (!$fileName) {
            return response()->json(['error' => 'Invalid file name'], 400);
        }

        $tempDir = storage_path('app/files/temp/' . $fileName);
        if (!file_exists($tempDir)) {
            return response()->json(['uploadedChunks' => []]);
        }

        $uploadedChunks = array_diff(scandir($tempDir), ['.', '..']);
        return response()->json(['uploadedChunks' => array_map('intval', $uploadedChunks)]);
    }


    public function uploadChunk(Request $request)
    {

        $fileName = $request->get('fileName');
        $chunkIndex = $request->get('chunkIndex');
        $totalChunks = $request->get('totalChunks');

        if (!$fileName || $chunkIndex === null || !$totalChunks || !$request->hasFile('file')) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $tempDir = Storage::path('public/files/temp/'.$fileName);
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $file = $request->file('file');
        $file->move($tempDir, $chunkIndex);

        if (count(scandir($tempDir)) - 2 === (int) $totalChunks) {
            $finalFileName = "F-" . rand(100, 999) . $fileName;
            $finalPath = Storage::path('public/files/'.$finalFileName);
            $finalFile = fopen($finalPath, 'w');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkPath = $tempDir . '/' . $i;
                $chunk = fopen($chunkPath, 'r');
                while ($data = fread($chunk, 1024)) {
                    fwrite($finalFile, $data);
                }
                fclose($chunk);
                unlink($chunkPath);
            }

            fclose($finalFile);
            rmdir($tempDir);

            $mimeType = $this->fileService->getFileMimeTypeByPath($finalPath);

            File::create([
                'file_path' =>  'files/' . $finalFileName,
                'file_name' => substr($fileName, strpos($fileName, '_x_') + 3),
                'mime_type' => $mimeType,
                'fileable_id' => null,
                'fileable_type' => null
            ]);

            return response()->json(['message' => 'Upload complete']);
        }

        return response()->json(['message' => 'Chunk uploaded']);
    }

    public function cancelUpload(Request $request){

        $fileName = $request->input('fileName');
        if (!$fileName) {
            return response()->json(['error' => 'Invalid file name'], 400);
        }

        $dir = Storage::path('public/files/temp/'.$fileName);
        $this->fileService->deleteDirectoryIfExists($dir);

        return response()->json(['success' => true,'message' => 'File upload canceled!']);
    }

}
