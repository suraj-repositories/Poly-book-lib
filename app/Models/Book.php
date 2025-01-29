<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fileable = [
        'title',
        'author',
        'cover_page',
        'pages',
        'description',
        'price',
        'branch_semester_id',
    ];

    public function getCoverPageUrl(){
        if (empty($this->image) || !Storage::disk('public')->exists($this->image)) {
            return config('constants.default_cover_page_image');
        }

        return Storage::url($this->image);
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
