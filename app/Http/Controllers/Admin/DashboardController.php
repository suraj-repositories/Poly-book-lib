<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookDownload;
use App\Models\Branch;
use App\Models\Contact;
use Carbon\Carbon;
use Database\Seeders\BookSeeder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){

        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // analysis cards
        $bookCount = Book::count();
        $bookCountLastMonth = Book::whereBetween('created_at', [$startDate, $endDate])->count();

        $branchCount = Branch::count();
        $branchCountLastMonth = Branch::whereBetween('created_at', [$startDate, $endDate])->count();

        $downloadCount = BookDownload::count();
        $downloadCountLastMonth = BookDownload::whereBetween('created_at', [$startDate, $endDate])->count();

        $contactCount = Contact::count();
        $contactCountLastMonth = Contact::whereBetween('created_at', [$startDate, $endDate])->count();

        return view('admin.dashboard.dashboard');
    }
}
