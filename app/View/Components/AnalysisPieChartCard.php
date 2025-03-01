<?php

namespace App\View\Components;

use App\Models\BookDownload;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Subscriber;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnalysisPieChartCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $analyticData = [];

    public $percentages = [];

    public function __construct()
    {
        //
        $downloads = BookDownload::count();
        $reviews = Review::count();
        $subscribers = Subscriber::count();
        $contact = Contact::count();

        $this->analyticData = [
            'downloads' => $downloads,
            'subscribers' => $subscribers,
            'contact' => $contact,
            'reviews' => $reviews,
        ];

        $total = $downloads + $reviews + $subscribers + $contact;

        if($total != 0){
            $this->percentages = [
                'downloads' => $downloads / $total * 100,
                'subscribers' => $subscribers / $total * 100,
                'contact' => $contact / $total * 100,
                'reviews' => $reviews / $total * 100,
            ];
        }
        else{
            $this->percentages = [
                'downloads' => 0,
                'subscribers' => 0,
                'contact' => 0,
                'reviews' => 0,
            ];
        }





    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.analysis-pie-chart-card');
    }
}
