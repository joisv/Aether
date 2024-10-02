<?php

namespace App\Livewire\Dashboard\Products;

use App\Models\Category;
use App\Models\ProductImage;
use App\Models\User;
use App\Traits\setSlug;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Mary\Traits\WithMediaSync;
use App\Models\Product;
use Livewire\Component;

class Edit extends Component
{
    use setSlug, Toast, WithFileUploads, WithMediaSync;

    public string $name;
    public string $slug;
    public string $description;
    public string $date;
    public ?int $category_id = null;
    public $categories;
    public int $stock;
    public int $price;
    public bool $visible = true;
    public bool $showDrawer = false;
    public bool $myModal2 = false;
    #[Rule(['files.*' => 'image|max:2048'])]
    public array $files = [];
    // Library metadata (optional validation)
    #[Rule('required')]
    public ?Collection $library;
    public ?User $user = null;
    
    public Product $product;
    

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' > 'required|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'visible' => 'required|boolean'
        ]);
        
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'visible' => $this->visible,
            'created_at' => $this->date
            
        ]);
        
        foreach ($this->files as $key => $file) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $file->store('product_image'),
            ]);
        }
        $this->syncMedia($this->user); 
        
        $this->reset();
        $this->success(
            'Product created successfully',
            'You will <strong>love it :)</strong>',
            position: 'toast-top toast-end',
            icon: 'o-heart',
            css: 'bg-primary text-base-100'
        );
        $this->redirectRoute    ('products');
    }
    
    #[On('setSlug')]
    public function slugAttr()
    {
        if (!empty($this->name)) {
            $this->setSlugAttribute(Product::class, $this->name);
            $this->slug =  $this->sluggable;
        }
    }
    
    public function search(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Category::where('id', $this->category_id)->get();
 
        $this->categories = Category::query()
            ->where('name', 'like', "%$value%")
            ->take(10)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }
    
    
    public function mount(Product $product) : void {

        
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->date = $product->created_at;
        $this->category_id = $product->category_id;
        $this->stock = $product->stock;
        $this->price = $product->price;
        $this->visible = $product->visible;
        $this->library = $product->product_images;
        $this->user = Auth::user();
        $this->categories = Category::all();
    }
    
    public function render()
    {
        return view('livewire.dashboard.products.edit');
    }
}
