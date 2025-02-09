<?php

namespace App\View\Components;

use App\Models\BranchSemester;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DownloadCatalog extends Component
{
    public $books;
    public $downloads;
    /**
     * Create a new component instance.
     */

    public function __construct($branch = null, $semester = null, $book = null)
    {
        //
        if($branch && $semester){
            $this->books = $semester->onBranchGetbooks($branch->id);
            $this->downloads = $semester->onBranchGetDownloads($branch->id);
        }elseif($branch){
            $this->books = $branch->books;
            $this->downloads = $branch->downloads;
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.download-catalog');
    }
}
