<?php

namespace App\View\Components;

use App\Models\SocialMedia;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialMediaIcons extends Component
{
    public $socialMedias;

    /**
     * Create a new component instance.
     */

    public function __construct()
    {
        //
        $this->socialMedias = SocialMedia::get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.social-media-icons');
    }
}
