<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookDownload;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //

    public function index(){
        $downloads = BookDownload::orderBy('id', 'desc')->get();
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last30days = BookDownload::whereBetween('created_at', [$startDate, $endDate])->count();
        return view('admin.download.downloads', compact('downloads', 'last30days'));
    }
}
