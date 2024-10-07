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
use Illuminate\Support\Facades\Storage;

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
            'slug' => 'required|string|unique:products,slug,'. $this->product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'visible' => 'required|boolean'
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'visible' => $this->visible,
            'created_at' => $this->date,
            'slug' => $this->slug

        ]);

        $libraryIds = $this->library->pluck('id')->filter()->toArray();

        // Ambil semua gambar ProductImage yang tidak ada di dalam $library
        $productImagesToDelete = ProductImage::whereNotIn('id', $libraryIds)->get();
        foreach ($productImagesToDelete as $productImage) {
            Storage::delete($productImage->image_path);
            $productImage->delete();
        }
        foreach ($this->files as $key => $file) {
            ProductImage::create([
                'product_id' => $this->product->id,
                'image_path' => $file->store(path:'product_image'),
            ]);
        }


        $this->reset();
        $this->success(
            'Product created successfully',
            'You will <strong>love it :)</strong>',
            position: 'toast-top toast-end',
            icon: 'o-heart',
            css: 'bg-primary text-base-100'
        );
        $this->redirectRoute('products');
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


    public function mount(Product $product): void
    {


        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->date = $product->created_at;
        $this->category_id = $product->category_id;
        $this->stock = $product->stock;
        $this->price = $product->price;
        $this->visible = $product->visible;
        $this->user = Auth::user();
        $this->categories = Category::all();
        if (!$product->product_images->isEmpty()) {
            # code...
            $this->library = ProductImage::where('product_id', $product->id)
            ->get()
            ->map(function ($image) {
                return [
                    'id' => $image->id,
                    'uuid' => "mary" . md5($image->id . $image->image_path),
                    'url' => asset('storage/' . $image->image_path),
                ];
            });
        } else {
            $this->library = new Collection();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.products.edit');
    }
}
