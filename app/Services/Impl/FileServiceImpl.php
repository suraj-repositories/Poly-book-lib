<?php

namespace App\Services\Impl;

use App\Services\FileService;
use Illuminate\Support\Facades\Storage;

class FileServiceImpl implements FileService
{


    public function uploadFile(\Illuminate\Http\UploadedFile $file, string $folder = "uploads", string $disk = "public"): string
    {
       if($file->getSize() > 0){
           return $file->store($folder, $disk);
       }
       $uniqueFileName = pathinfo($this->getFileName($file), PATHINFO_FILENAME) . '-' . time() . '-' . uniqid() . '.' . $this->getExtension($file);
       return $file->storeAs($folder, $uniqueFileName, $disk);
    }

    public function getFileName(\Illuminate\Http\UploadedFile $file): string
    {
        return $file->getClientOriginalName();
    }

    public function getExtension(\Illuminate\Http\UploadedFile $file): string{
        return $file->getClientOriginalExtension();
    }

    public function getMimeType(\Illuminate\Http\UploadedFile $file): string
    {
        return $file->getClientMimeType() ?? 'Unknown';
    }

    public function getFileNameByPath($filePath): string{
        return pathinfo($filePath, PATHINFO_FILENAME) ?? "-";
    }

    public function getFileMimeTypeByPath($filePath): string{
        return mime_content_type($filePath) ?? "Unknown";
    }

    public function getExtensionByPath($filePath): string{
        return pathinfo($filePath, PATHINFO_EXTENSION) ?? null;
    }

    public function getIconFromExtension($extension): string{
        return config('extension')['icons'][$extension] ?? config('extension')['DEFAULT_FILE_ICON'];
    }

    public function getAllAvailableIcons(): array{
        return config('extension')['icons'] ?? [];
    }

    public function getSizeByPath($filePath): string{
        if (!file_exists($filePath)) {
            return "File does not exist.";
        }

        $size = filesize($filePath);
        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        $unitIndex = 0;
        while ($size >= 1024 && $unitIndex < count($units) - 1) {
            $size /= 1024;
            $unitIndex++;
        }

        return round($size, 2) . ' ' . $units[$unitIndex];
    }

    function deleteIfExists($filePath){
        if ($filePath && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
            return 1;
        }

        return 0;
    }

}
