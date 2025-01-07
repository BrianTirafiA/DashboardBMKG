<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProgressBar extends Component
{
    public $percentage;
    public $title;

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param int $percentage
     */
    public function __construct($title = '', $percentage = 0)
    {
        $this->title = $title;
        $this->percentage = max(0, min(100, (int) $percentage)); // Clamp percentage between 0 and 100
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.progress-bar');
    }
}
