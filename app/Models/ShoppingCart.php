<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'shopping_cart_product')
                    ->withPivot('quantity') // Menyimpan jumlah produk di tabel pivot
                    ->withTimestamps();
    }
}
