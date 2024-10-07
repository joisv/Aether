<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use App\Traits\HasLivewireAlert;
use App\Traits\HasSortingPaginationSearch;
use Livewire\Attributes\On;
use Livewire\Component;

class Categories extends Component
{
    use HasSortingPaginationSearch, HasLivewireAlert;

    public bool $modal_create = false;
    public bool $modal_edit = false;

    public function editModal($id)
    {
        $this->modal_edit = true;
        $this->dispatch('edit-category', id: $id);
    }
    
    
    public function getData()
    {
        $query = Category::query();
        
        if ($this->search) {
            $query->search(['name', 'created', 'updated_at'], $this->search);
        }

        if (in_array($this->sortField, ['finish', 'pending', 'ongoing'])) {
            $query->where('status', $this->sortField);
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        // Jangan panggil get() di sini, biarkan query builder tetap sebagai objek query
        return $query;
    }

    #[On('close')]
    public function closeModal()
    {
        $this->modal_create = false;
        $this->modal_edit = false;
    }
    
    #[On('delete')]
    public function deleteSeries($data)
    {
        $this->mySelected = $data['value'];
        // $this->mySelected = array_filter($this->mySelected, function($value) {
        //     return is_int($value);
        // });
        $this->bulkDelete(Category::class, 'Series deleted successfully');
    }
    
    public function render()
    {
        $query = $this->getSeriesQuery(Category::class, ['name', 'created', 'updated_at'], [])->paginate($this->paginate);
        return view('livewire.dashboard.categories.categories', [
            'categories' => $query
        ]);
    }
}
