<?php

namespace App\Modules\Tus\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class TuGuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('tu.layouts.guest');
    }
}
