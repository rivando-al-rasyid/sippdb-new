<?php

namespace App\Modules\TUS\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TUAppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('tu.layouts.app');
    }
}
