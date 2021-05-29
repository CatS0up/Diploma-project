<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Rating extends Component
{
    public float $rate;
    public string $parentName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(float $rate, string $parentName)
    {
        $this->rate = $rate;
        $this->parentName = $parentName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rating');
    }
}
