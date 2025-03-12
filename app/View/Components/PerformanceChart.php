<?php

namespace App\View\Components;

use App\Models\Download;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PerformanceChart extends Component
{
    public $downloadMonthyRecord;
    public $usersMonthyRecord;
    public $halfMonthlyDownloads;
    public $halfMonthlyUsers;
    public $yearlyUsers;
    public $yearlyDownloads;
    public $dailyDownloads;
    public $dailyUsers;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        // --------------------------------------------
        // calculate book download monthly
        // --------------------------------------------
        $months = collect(range(0, 11))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('M');
        })->reverse();

        $downloadsRecord = Download::selectRaw("DATE_FORMAT(created_at, '%b') AS month, COUNT(*) AS total_records")
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderByRaw("MIN(created_at) ASC")
            ->pluck('total_records', 'month');

        $this->downloadMonthyRecord = $months->mapWithKeys(function ($month) use ($downloadsRecord) {
            return [$month => $downloadsRecord[$month] ?? 0];
        });

        // --------------------------------------------
        // calculate users appear monthly
        // --------------------------------------------
        $usersRecord = User::selectRaw("DATE_FORMAT(created_at, '%b') AS month, COUNT(*) AS total_records")
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderByRaw("MIN(created_at) ASC")
            ->pluck('total_records', 'month');

        $this->usersMonthyRecord = $months->mapWithKeys(function ($month) use ($usersRecord) {
            return [$month => $usersRecord[$month] ?? 0];
        });


        // --------------------------------------------
        // Generate Last 6 Months in 15-Day Slots
        // --------------------------------------------
        $startDate = Carbon::now()->subMonths(6)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $halfMonthlyPeriods = [];
        $current = clone $endDate;

        while ($current >= $startDate) {
            $month = $current->format('M');

            $halfMonthlyPeriods["$month-2"] = 0;
            $halfMonthlyPeriods["$month-1"] = 0;

            $current->subMonth();
        }

        // --------------------------------------------
        // Fetch Book Downloads Data (Grouped by 15 Days)
        // --------------------------------------------
        $downloads = Download::selectRaw("
            CONCAT(DATE_FORMAT(created_at, '%b'),
                   IF(DAY(created_at) <= 15, '-1', '-2')) AS half_month,
            COUNT(*) AS total_records
        ")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('half_month')
            ->pluck('total_records', 'half_month')
            ->toArray();

        $this->halfMonthlyDownloads = array_reverse(array_merge($halfMonthlyPeriods , $downloads));

        // --------------------------------------------
        // Fetch User Registrations Data (Grouped by 15 Days)
        // --------------------------------------------
        $users = User::selectRaw("
            CONCAT(DATE_FORMAT(created_at, '%b'),
                   IF(DAY(created_at) <= 15, '-1', '-2')) AS half_month,
            COUNT(*) AS total_records
        ")
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('half_month')
            ->pluck('total_records', 'half_month')
            ->toArray();

        $this->halfMonthlyUsers = array_reverse(array_merge($halfMonthlyPeriods , $users));


        // --------------------------------------------
        // calculate downloads daily
        // --------------------------------------------
        $dailyStartDate = Carbon::now()->subDays(30)->startOfDay();

        $dailyPeriods = collect(range(0, 29))->mapWithKeys(fn($i) => [
            Carbon::now()->subDays($i)->format('d M') => 0
        ]);

        $dailyDownloads = Download::selectRaw("DATE(created_at) as date, COUNT(*) as total_records")
            ->where('created_at', '>=', $dailyStartDate)
            ->groupBy('date')
            ->get()
            ->mapWithKeys(fn($row) => [
                Carbon::parse($row->date)->format('d M') => $row->total_records
            ])
            ->toArray();

        $this->dailyDownloads = array_merge(array_reverse($dailyPeriods->toArray()), $dailyDownloads);

        // --------------------------------------------
        // calculate users daily
        // --------------------------------------------
        $dailyUsers = User::selectRaw("DATE(created_at) as date, COUNT(*) as total_records")
            ->where('created_at', '>=', $dailyStartDate)
            ->groupBy('date')
            ->get()
            ->mapWithKeys(fn($row) => [
                Carbon::parse($row->date)->format('d M') => $row->total_records
            ])
            ->toArray();

        $this->dailyUsers = array_merge(array_reverse($dailyPeriods->toArray()), $dailyUsers);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.performance-chart');
    }
}
