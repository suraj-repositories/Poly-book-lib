<?php

namespace App\View\Components\Web;

use App\Models\HeroSection;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AboutContent extends Component
{
    /**
     * Create a new component instance.
     */
    public $heroSection;

    public function __construct()
    {
        //
        $this->heroSection = HeroSection::first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.web.about-content');
    }
}
