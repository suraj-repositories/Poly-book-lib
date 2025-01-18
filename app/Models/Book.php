<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fileable = [
        'title',
        'author',
        'cover_page',
        'pages',
        'description',
        'price',
    ];

    public function file(){
        return $this->morphOne(File::class, 'fileable');
    }

    public function getCoverPageUrl(){
        if (empty($this->image) || !Storage::disk('public')->exists($this->image)) {
            return config('constants.default_cover_page_image');
        }

        return Storage::url($this->image);
    }

}
