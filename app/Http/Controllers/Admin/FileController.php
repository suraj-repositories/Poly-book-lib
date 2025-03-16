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

    public function index(){
        $files  = File::latest()->get();

        foreach ($files as $file) {
            $filePath = $file->file_path;
            $size = Storage::disk('private')->exists($filePath) ? $this->fileService->getSizeByPath($filePath, 'private') : '-';
            $file->size = $size;
            $file->icon = $this->fileService->getIconFromExtension($this->fileService->getExtensionByPath($filePath));
        }
        return view('admin.files.show_files', compact('files'));
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
        $filePath = $this->fileService->uploadFile($request->file('file'), "files", 'private');
        $fileSize = $file->getSize();
        File::create([
            'file_path' =>  $filePath,
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'file_size' => $fileSize
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

        $tempDir = Storage::path('private/files/temp/'.$fileName);
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $file = $request->file('file');
        $file->move($tempDir, $chunkIndex);

        if (count(scandir($tempDir)) - 2 === (int) $totalChunks) {
            $finalFileName = "F-" . rand(100, 999) . $fileName;
            $finalPath = Storage::path('private/files/'.$finalFileName);
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
                'file_size' => Storage::disk('private')->size('files/' . $finalFileName) ?? null
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

        $dir = Storage::path('private/files/temp/'.$fileName);
        $this->fileService->deleteDirectoryIfExists($dir);

        return response()->json(['success' => true,'message' => 'File upload canceled!']);
    }

    public function destroy(File $file){

        $this->fileService->deleteIfExists($file->file_path);

        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully!');
    }

    // public function documentPreview($type, Request $request){

    //     $filePath = $request->query('fileName');
    //     $imagick = new Imagick();
    //     $imagick->readImage($filePath . '[0]'); // Read the first page
    //     $imagick->setImageFormat('png');

    //     // Set the appropriate headers for the image
    //     return response($imagick->getImagesBlob(), 200, [
    //         'Content-Type' => 'image/png',
    //         'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
    //     ]);
    // }

}
