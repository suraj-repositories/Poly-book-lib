<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchSemester extends Model
{
    use HasFactory;

    protected $table = 'branch_semester';

    public function books()
    {
        return $this->hasMany(Book::class, 'branch_semester_id');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($branchSemester) {
            $branchSemester->books()->delete();
        });
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function semester(){
        return $this->belongsTo(Semester::class, 'semester_id');
    }



}
