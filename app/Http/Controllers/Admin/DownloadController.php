<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //

    public function index(){
        $downloads = Download::orderBy('id', 'desc')->get();
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = Download::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.download.downloads', compact('downloads', 'last30days'));
    }
}
