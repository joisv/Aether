<?php

namespace App\Traits;

use Livewire\WithPagination;

trait HasSortingPaginationSearch
{
    use WithPagination;

    public string $sortField = 'updated_at';
    public string $sortDirection = 'desc';
    public string $search = '';
    public int $paginate = 10;

    public $mySelected = [];
    public $selectedAll = false;

    
    public function updatedSelectedAll($val)
    {
        $val ? $this->mySelected = $this->getData()->limit($this->paginate)->pluck('id') : $this->mySelected = [];
    }
    
    public function updatedMySelected()
    {
        if (count($this->mySelected) === $this->paginate) {
            $this->selectedAll = true;
        } else {
            $this->selectedAll = false;
        }
    }

    public function updatedPage($page)
    {
        $this->mySelected = [];
        $this->selectedAll = false;
    }

    public function getSeriesQuery($model, array $searchFields, array $withRelations = [])
    {
        // Gunakan relasi yang customizable
        $query = $model::query();

        if (!empty($withRelations)) {
            $query->with($withRelations); // Load relasi yang diinginkan
        }

        // Gunakan macro search yang telah didefinisikan
        if ($this->search) {
            $query->search($searchFields, $this->search);
        }

        if (in_array($this->sortField, ['finish', 'pending', 'ongoing'])) {
            $query->where('status', $this->sortField);
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return $query;
    }
}
