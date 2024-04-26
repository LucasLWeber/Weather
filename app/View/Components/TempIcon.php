<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TempIcon extends Component
{
    public string $date;
    public string $url;
    public string $temp;
    public function __construct($date, $url, $temp)
    {
       $this->date = $date;
       $this->url = $url;
       $this->temp = $temp;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.temp-icon');
    }
}
