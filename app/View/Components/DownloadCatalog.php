<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DownloadCatalog extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($branch = null, $semester = null, $book = null)
    {
        //

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.download-catalog');
    }
}
