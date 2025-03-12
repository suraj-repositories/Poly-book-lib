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
            Book::class,
            BranchSemester::class,
            'semester_id',
            'branch_semester_id',
            'id',
            'id'
        );
        // return $this->hasManyThrough(
        //     Semester::class,
        //     BranchSemester::class,
        //     'branch_id',
        //     'id',
        //     'id',
        //     'semester_id'
        // );
    }

    public function onBranchGetbooks($branchId)
    {
        $branchSemesters = BranchSemester::where('branch_id', $branchId)
            ->where('semester_id', $this->id)
            ->get();

        $books = $branchSemesters->flatMap(function ($branchSemester) {
            return Book::where('branch_semester_id', $branchSemester->id)->get();
        });
        return $books->values();
    }

    public function downloads()
    {
        return Download::whereHasMorph(
            'downloadable',
            [Book::class],
            function ($query) {
                $query->whereIn('branch_semester_id', $this->branchSemesters()->pluck('id'));
            }
        );
    }

    public function onBranchGetDownloads($branchId)
    {
        return Download::whereHasMorph(
            'downloadable',
            [Book::class],
            function ($query) use ($branchId) {
                $query->whereHas('branchSemester', function ($subQuery) use ($branchId) {
                    $subQuery->where('branch_id', $branchId)->where('semester_id', $this->id);
                });
            }
        )->get();
    }
}
