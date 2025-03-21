<?php

namespace App\Services;

interface FileService
{
    function uploadFile(\Illuminate\Http\UploadedFile $file, string $folder = "uploads", string $disk = "public"): string;

    function fileExists($filePath, string $disk = "public");

    function deleteIfExists($filePath);

    function getFileName(\Illuminate\Http\UploadedFile $file): string;

    function getExtension(\Illuminate\Http\UploadedFile $file): string;

    function getMimeType(\Illuminate\Http\UploadedFile $file): string;

    function getFileNameByPath($filePath): string;

    function getFileMimeTypeByPath($filePath): string;

    function getExtensionByPath($filePath): string;

    function getIconFromExtension($extension): string;

    function getAllAvailableIcons(): array;

    function getSizeByPath($filePath, $disk = "public"): string;

    function getFromattedFileSize($size, $roundPosition = 2, $sepertor = " ");

    function deleteDirectoryIfExists($dir);

    function getFirstPage($pdfFilePath);
}
