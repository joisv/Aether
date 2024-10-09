<?php

namespace App\Livewire\Dashboard\Customers;

use App\Models\User;
use App\Traits\HasLivewireAlert;
use App\Traits\HasSortingPaginationSearch;
use Livewire\Attributes\On;
use Livewire\Component;

class Customers extends Component
{

    use HasSortingPaginationSearch, HasLivewireAlert;
   
    public function getData()
    {
        $query = User::query();
        
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
    
    #[On('delete')]
    public function deleteSeries($data)
    {
        $this->mySelected = $data['value'];
        $this->bulkDelete(User::class, 'Series deleted successfully');
    }
    
    public function render()
    {
        $query = $this->getSeriesQuery(User::class, ['name', 'created', 'updated_at'], [])->paginate($this->paginate);
        
        return view('livewire.dashboard.customers.customers', [
            'customers' => $query
        ]);
    }
}
