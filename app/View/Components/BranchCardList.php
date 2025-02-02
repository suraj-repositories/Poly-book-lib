<?php

namespace App\View\Components;

use App\Models\Branch;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class BranchCardList extends Component
{
    public $maxCards;
    public $isPagination;
    public $shuffle;

    public $branches = null;

    /**
     * Create a new component instance.
     */
    public function __construct($maxCards = null, $isPagination = false, $shuffle = false)
    {
        //
        $this->maxCards = $maxCards;
        $this->isPagination = $isPagination;
        $this->shuffle = $shuffle;


        if ($maxCards && $isPagination) {
            $this->branches = Branch::paginate($maxCards);
        } elseif ($maxCards) {
            $this->branches = Branch::take($maxCards)->get();
        } elseif ($isPagination) {
            $this->branches = Branch::paginate(12);
        }

        if ($this->shuffle && !$this->isPagination && $this->branches) {
            $this->branches = $this->branches->shuffle();
        }

        if(!$this->branches){
            $this->branches = new Collection();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.branch-card-list');
    }
}
