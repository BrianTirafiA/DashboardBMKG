<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RackTable extends Component
{
    public $capacity; // Kapasitas rak (jumlah U)

    /**
     * Create a new component instance.
     *
     * @param int $capacity
     */
    public function __construct($capacity = 42)
    {
        $this->capacity = $capacity;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rack-table');
    }
}
