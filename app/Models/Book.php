<?php

namespace App\Models;

use App\Services\Impl\FileServiceImpl;
use App\Traits\Downloadable;
use App\Traits\Purchasable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory, Downloadable, Purchasable;

    protected $fileable = [
        'title',
        'author',
        'cover_image',
        'pages',
        'description',
        'price',
        'branch_semester_id',
    ];

    public function getCoverPageUrl()
    {
        if (empty($this->cover_image) || !Storage::disk('public')->exists($this->cover_image)) {
            return config('constants.default_cover_page_image');
        }

        return Storage::url($this->cover_image);
    }

    public function getImageURL(){
        return $this->getCoverPageUrl();
    }

    public function getCoverImageSize()
    {
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

    public function downloads()
    {
        return $this->morphMany(Download::class, 'downloadable');
    }

    public function scopeOrderByDownloads($query)
    {
        return $query->withCount('downloads')->orderBy('downloads_count', 'desc');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
