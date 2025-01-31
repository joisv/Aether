<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function product_images()
    {
       return $this->hasMany(ProductImage::class);
    }

    public function shoppingCarts()
    {
        return $this->belongsToMany(ShoppingCart::class, 'shopping_cart_product')
            ->withPivot('quantity') // Menyimpan jumlah produk di tabel pivot
            ->withTimestamps();
    }
}
