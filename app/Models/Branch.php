<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($branch) {
            $branch->branchSemesters->each(function ($branchSemester) {
                $branchSemester->books()->delete();
                $branchSemester->delete();
            });
        });

        static::updated(function ($branch) {
            if ($branch->isDirty('branchSemesters')) {
                $branch->branchSemesters()->detach();
            }
        });
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    public function getImageUrl()
    {
        if (empty($this->image) || !Storage::disk('public')->exists($this->image)) {
            return config('constants.default_branch_image');
        }

        return Storage::url($this->image);
    }

    public function semestersCount()
    {
        return count($this->semesters);
    }

    public function branchSemesters()
    {
        return $this->hasMany(BranchSemester::class, 'branch_id');
    }
}
