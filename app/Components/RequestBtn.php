<?php

namespace App\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class RequestBtn extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.request-button');
    }
}
