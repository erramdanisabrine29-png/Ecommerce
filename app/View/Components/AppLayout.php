<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Use the component-based layout so <x-app-layout> renders the slot
        // (the Blade view at resources/views/components/layouts/app.blade.php).
        return view('components.layouts.app');
    }
}
