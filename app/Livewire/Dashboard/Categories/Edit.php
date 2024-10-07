<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use App\Traits\setSlug;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Edit extends Component
{
    use setSlug, Toast;
    
    public string $name;
    public string $slug;
    public Category $category;
    
    
    public function save_edit()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,'. $this->category->id,
            'slug' => 'required|unique:categories,slug,'. $this->category->id,
        ]);

        $this->category->update([
            'name' => $this->name,
            'slug' => $this->setSlugAttribute(Category::class, $this->slug),
        ]);

        $this->dispatch('close')->to(Categories::class);

        $this->success(
            'Category updated successfully',
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
    
    #[On('edit-category')]
    public function editMount($id)
    {
        $category = Category::find($id);
        $this->category = $category;
        $this->name = $category?->name;
        $this->slug = $category?->slug;
    }
    
    public function render()
    {
        return view('livewire.dashboard.categories.edit');
    }
}
