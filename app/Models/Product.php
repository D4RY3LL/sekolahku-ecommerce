<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'old_price',
        'stock',
        'weight',
        'brand',
        'image',
        'rating',
        'sold_count',
        'is_featured',
        'is_best_seller'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->old_price && $this->old_price > $this->price) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function updateRating()
    {
        $this->rating = $this->reviews()->avg('rating') ?? 0;
        $this->save();
    }

    public function getImageUrlAttribute()
    {
        // Dummy images array
        $images = [
            'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=400&fit=crop',
            'https://images.unsplash.com/photo-1532012197267-da84d127e765?w=400&h=400&fit=crop',
            'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400&h=400&fit=crop',
            // ... tambahkan semua URL gambar
        ];

        $index = $this->id % count($images);
        return $images[$index];
    }
}
