<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {

    // products
    Route::view('products', 'dashboard.products.products')
        ->name('products');

    Route::view('product/create', 'dashboard.products.create')
    ->name('product.create');
    Route::get('product/edit/{product:id}', function(Product $product){

        return view('dashboard.products.edit', [
            'product' => $product->load(['category', 'product_images'])
        ]);
        
    })->name('product.edit');

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
});


require __DIR__ . '/auth.php';
