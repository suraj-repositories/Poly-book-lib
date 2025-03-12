<?php

namespace App\View\Components;

use App\Models\Book;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\Download;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardAnalysisCards extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $bookCount = Book::count();
        $bookCountLastMonth = Book::whereBetween('created_at', [$startDate, $endDate])->count();

        $branchCount = Branch::count();
        $branchCountLastMonth = Branch::whereBetween('created_at', [$startDate, $endDate])->count();

        $downloadCount = Download::count();
        $downloadCountLastMonth = Download::whereBetween('created_at', [$startDate, $endDate])->count();

        $contactCount = Contact::count();
        $contactCountLastMonth = Contact::whereBetween('created_at', [$startDate, $endDate])->count();

        return view(
            'components.dashboard-analysis-cards',
            compact(
                'bookCount',
                'bookCountLastMonth',
                'branchCount',
                'branchCountLastMonth',
                'downloadCount',
                'downloadCountLastMonth',
                'contactCount',
                'contactCountLastMonth',
            )
        );
    }
}
