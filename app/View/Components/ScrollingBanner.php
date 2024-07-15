<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ScrollingBanner extends Component
{
    public array $images;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($images)
    {
        $this->images = $images;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): string|View
    {
        return view('components.scrolling-banner');
    }
}
