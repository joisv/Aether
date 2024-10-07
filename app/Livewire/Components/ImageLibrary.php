<?php

namespace App\Livewire\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageLibrary extends Component
{

    use WithFileUploads;

    #[Modelable]
    public $product_images = [];
    
    public function updatedProductImages()
    {
        dd($this->product_images);
    }
    
    public function render()
    {
        return view('livewire.components.image-library');
    }
}
