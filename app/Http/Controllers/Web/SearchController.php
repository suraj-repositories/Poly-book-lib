<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Branch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request){
        $search = '';

        if($request->has('search')){
            $search = $request->search;
        }

        if(empty(trim($search))){
            return response()->json([
                'status' => 'error',
                'message' => 'Search field is empty!',
                'data' =>  ''
            ]);
        }

        $resultBranches = Branch::where('name', 'like', "%$search%")
        ->orWhereHas('books', function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('author', 'like', "%$search%");
        })
        ->with(['books' => function ($query) use ($search) {
            $query->where('title', 'like', "%$search%")
                  ->orWhere('author', 'like', "%$search%");
        }])
        ->get();


        return response()->json([
            'status' => 'success',
            'message' => 'Searching Completed!',
            'data' => view('web.search.search_result', compact('resultBranches', 'search'))->render()
        ]);

    }

}
