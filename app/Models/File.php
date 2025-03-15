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
        'file_size',
        'fileable_id',
        'fileable_type',
    ];

    // public function getFileUrl()
    // {

    //     if (Storage::disk('private')->exists($this->file_path)) {
    //         return route('file.serve', ['type' => $this->fileable_type , 'id'=>$this->fileable_id, 'filepath' => $this->file_path]);
    //     }
    //     return abort(404, 'Resource Not Available');

    // }

    public function extension()
    {
        if ($this->file_path && Storage::disk('private')->exists($this->file_path)) {
            return pathinfo($this->file_path, PATHINFO_EXTENSION) ?: null;
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
        return $fileService->getSizeByPath($this->file_path, 'private');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

}
