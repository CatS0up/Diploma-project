<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class Rating extends Component
{
    public float $rate;
    public string $parentName;
    public int $ratesAmount;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(float $rate, string $parentName, ?int $ratesAmount = null)
    {
        $this->rate = $rate;
        $this->parentName = $parentName;
        $this->ratesAmount = $ratesAmount;
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
