<?php

namespace App\Livewire\Dashboard\Settings;

use App\Settings\DashboardSettings;
use Livewire\Component;

class Basics extends Component
{

    
    public function render(DashboardSettings $settings)
    {
        return view('livewire.dashboard.settings.basics', [
            'settings' => $settings
        ]);
    }
}
