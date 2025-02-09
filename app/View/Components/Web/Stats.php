<?php

namespace App\View\Components\Web;

use App\Facades\Settings;
use App\Models\Book;
use App\Models\BookDownload;
use App\Models\Branch;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Stats extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $branchCount = Branch::count();
        $bookCount = Book::count();
        $downloadCount = BookDownload::count();

        $start = Carbon::parse(Settings::get('app_start_date', config('app.app_start_date')));
        $end = Carbon::parse(date('Y-m-d H:i:s'));

        $hoursOfSuppport = $start->diffInHours($end);

        return view('components.web.stats', compact('branchCount', 'bookCount', 'downloadCount', 'hoursOfSuppport'));
    }
}
