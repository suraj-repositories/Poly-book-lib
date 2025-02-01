<?php

namespace App\Models;

use App\Services\FileService;
use App\Services\Impl\FileServiceImpl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_path',
        'file_name',
        'mime_type',
        'fileable_id',
        'fileable_type',
    ];



    public function getFileUrl()
    {
        if (Storage::disk('public')->exists($this->file_path)) {
            return url('storage/' . $this->file_path);
        }
        return config('constants.question_mark_image_a4');
    }

    public function extension()
    {
        if (Storage::disk('public')->exists($this->file_path)) {
            return pathinfo($this->file_path, PATHINFO_EXTENSION) ?? null;
        }
        return null;
    }

    public function extensionIcon()
    {
        $fileService = new FileServiceImpl();
        return $fileService->getIconFromExtension(pathinfo($this->file_path, PATHINFO_EXTENSION) ?? null);
    }

    public function size()
    {
        $fileService = new FileServiceImpl();
        return $fileService->getSizeByPath($this->file_path);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

}
