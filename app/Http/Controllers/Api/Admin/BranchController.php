<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    //
    public function fetchBranches(Request $request)
    {
        $branches = null;

        $semesterId = $request->query('semester_id');
        $branchId = $request->query('branch_id');
        if ($branchId) {
            $branches = Branch::with(['semesters'])->where('branches.id', $branchId)->get();
        } else if ($semesterId) {
            $branches = Branch::whereHas('semesters', function ($query) use ($semesterId) {
                $query->where('semesters.id', $semesterId);
            })->with('semesters')->get();
        } else {
            $branches = Branch::with(['semesters'])->get();
        }

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'data' => BranchResource::collection($branches)
        ]);
    }
}
