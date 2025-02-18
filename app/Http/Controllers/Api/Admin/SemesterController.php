<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SemesterResource;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //

    public function fetchSemesters(Request $request)
    {
        $semesterId = $request->query('semester_id');
        $branchId = $request->query('branch_id');
        $branchName = $request->query('branch_name');

        $semesters = null;

        if (!empty($semesterId)) {
            $semesters = Semester::with('branches')->where('id', $semesterId)->get();
        } elseif (!empty($branchName)) {
            $semesters = Semester::whereHas('branches', function ($query) use ($branchName) {
                $query->where('branches.name', $branchName);
            })->with('branches')->get();
        }elseif (!empty($branchId)) {
            $semesters = Semester::whereHas('branches', function ($query) use ($branchId) {
                $query->where('branches.id', $branchId);
            })->with('branches')->get();
        }  else {
            $semesters = Semester::with('branches')->get();
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'data' => SemesterResource::collection($semesters),
        ]);
    }
}
