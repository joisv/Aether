<?php

namespace App\Livewire\Components;

use Livewire\Component;

class MobileNav extends Component
{
    public bool $showDrawer1 = true;
    
    public function render()
    {
        return view('livewire.components.mobile-nav');
    }
}
