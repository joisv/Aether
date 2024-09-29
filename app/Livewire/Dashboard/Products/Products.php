<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Product;
use App\Traits\HasLivewireAlert;
use App\Traits\HasSortingPaginationSearch;
use Livewire\Attributes\On;
use Livewire\Component;
use Mary\Traits\Toast;

class Products extends Component
{
    use HasSortingPaginationSearch, HasLivewireAlert, Toast;

    public function render()
    {
        // Custom relasi yang akan di-load
        $relations = ['category']; // Misal, kamu ingin menambahkan relasi lain juga

        $query = $this->getSeriesQuery(Product::class, ['name', 'created', 'updated_at'], $relations)->paginate($this->paginate);

        return view('livewire.dashboard.products.products', [
            'products' => $query
        ]);
    }

    public function getSeries()
    {
        $query = Product::with('category');
        
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
        // $this->mySelected = array_filter($this->mySelected, function($value) {
        //     return is_int($value);
        // });
        $this->bulkDelete(Product::class, 'Series deleted successfully');
    }
   
}
