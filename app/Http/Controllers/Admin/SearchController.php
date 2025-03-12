<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function page_search(Request $request)
    {

        if (empty($request->search)) {
            return redirect()->back();
        }

        $search = $request->search;
        $url = Page::where('scope', 'ADMIN')->where('title', 'LIKE', '%' . $search . '%')->value('url');

        if ($url) {
            return redirect()->to($url);
        }
        return redirect()->back()->with([
            'search_success' => false,
            'search' => $search
        ]);
    }
}
