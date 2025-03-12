<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\BookSeeder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $popularBooks = Book::orderByDownloads()->having('downloads_count', '>', 0)->take(5)->get();
        $topUsers = User::orderByDownloads()->having('downloads_count', '>', 0)->take(7)->get();

        return view('admin.dashboard.dashboard', compact('popularBooks', 'topUsers'));
    }
}
