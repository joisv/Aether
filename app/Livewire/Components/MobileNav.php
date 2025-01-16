<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class MobileNav extends Component
{
    public bool $showDrawer1 = false;

    public function render()
    {
        return view('livewire.components.mobile-nav');
    }
}
