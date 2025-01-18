<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type'
    ];

    public function fileable(){
        return $this->morphTo();
    }

    public function getFileUrl(){
        if(Storage::disk('public')->exists($this->file_path)){
            return url('storage/'.$this->file_path);
        }
        return config('constants.default_file_image');
    }

}
