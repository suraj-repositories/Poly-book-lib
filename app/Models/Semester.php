<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'image'];

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }


    public function getImageUrl()
    {
        if (empty($this->image) || !Storage::disk('public')->exists($this->image)) {
            return config('constants.default_semester_image');
        }

        return Storage::url($this->image);
    }

    public function books()
    {
        return $this->hasManyThrough(
            Semester::class,
            BranchSemester::class,
            'branch_id',
            'id',
            'id',
            'semester_id'
        );
    }
}
