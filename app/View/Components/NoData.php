<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoData extends Component
{
    public $icon, $bg_color, $color, $size, $text;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $icon = 'fluent-mdl2:search-data',
        $bg_color = '#ffe58880',
        $color = '#FFC530D1',
        $size = 50,
        $text='No Data'
    )
    {
        //
        $this->icon = $icon;
        $this->bg_color = $bg_color;
        $this->color = $color;
        $this->size = $size;
        $this->text = $text;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.no-data');
    }
}
