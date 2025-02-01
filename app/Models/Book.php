<?php

namespace App\Models;

use App\Services\Impl\FileServiceImpl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fileable = [
        'title',
        'author',
        'cover_image',
        'pages',
        'description',
        'price',
        'branch_semester_id',
    ];

    public function getCoverPageUrl(){
        if (empty($this->cover_image) || !Storage::disk('public')->exists($this->cover_image)) {
            return config('constants.default_cover_page_image');
        }

        return Storage::url($this->cover_image);
    }

    public function getCoverImageSize(){
        $fileService = new FileServiceImpl();
        return $fileService->getSizeByPath($this->cover_image) ?? null;
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function branchSemester()
    {
        return $this->belongsTo(BranchSemester::class);
    }

}
