<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {

    // products
    Route::view('products', 'dashboard.products.products')
        ->name('products');

    Route::view('product/create', 'dashboard.products.create')
    ->name('product.create');

    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
});


require __DIR__ . '/auth.php';
