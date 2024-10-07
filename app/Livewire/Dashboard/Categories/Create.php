<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use App\Traits\setSlug;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Create extends Component
{
    use setSlug, Toast;
    
    public string $name;
    public string $slug;

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute(Category::class, $this->slug)
        ]);

        $this->dispatch('close')->to(Categories::class);

        $this->success(
            'Category created successfully',
            'You will <strong>love it :)</strong>',
            position: 'toast-top toast-end',
            icon: 'o-heart',
            css: 'bg-primary text-base-100'
        );

        $this->reset(['name', 'slug']);
    }
    
    #[On('setSlug')]
    public function slugAttr()
    {
        if (!empty($this->name)) {
           $this->slug = $this->setSlugAttribute(Category::class, $this->name);
        }
    }
    
    public function render()
    {
        return view('livewire.dashboard.categories.create');
    }
}
