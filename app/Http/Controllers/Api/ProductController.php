<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\ProductImageHelper;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
                          ->latest()
                          ->paginate(20);
        
        // Tambahkan gambar ke setiap produk (berdasarkan kategori)
        $products->getCollection()->transform(function ($product) {
            $product->image_url = ProductImageHelper::getImageUrl($product->name, $product->category->name);
            $product->image_thumb = ProductImageHelper::getThumbUrl($product->name, $product->category->name);
            return $product;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ]);
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'reviews.user'])
                         ->where('slug', $slug)
                         ->first();
        
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
        
        // Tambahkan gambar
        $product->image_url = ProductImageHelper::getImageUrl($product->name, $product->category->name);
        $product->image_thumb = ProductImageHelper::getThumbUrl($product->name, $product->category->name);
        
        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully',
            'data' => $product
        ]);
    }

    public function bestSellers()
    {
        $products = Product::with('category')
                          ->where('sold_count', '>', 0)
                          ->orderBy('sold_count', 'desc')
                          ->limit(10)
                          ->get();
        
        // Tambahkan gambar ke setiap produk
        $products->transform(function ($product) {
            $product->image_url = ProductImageHelper::getImageUrl($product->name, $product->category->name);
            $product->image_thumb = ProductImageHelper::getThumbUrl($product->name, $product->category->name);
            return $product;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Best sellers retrieved successfully',
            'data' => $products
        ]);
    }

    public function promo()
    {
        $products = Product::with('category')
                          ->whereNotNull('old_price')
                          ->where('old_price', '>', 'price')
                          ->orderByRaw('((old_price - price) / old_price) DESC')
                          ->limit(10)
                          ->get();
        
        // Tambahkan gambar ke setiap produk
        $products->transform(function ($product) {
            $product->image_url = ProductImageHelper::getImageUrl($product->name, $product->category->name);
            $product->image_thumb = ProductImageHelper::getThumbUrl($product->name, $product->category->name);
            return $product;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Promo products retrieved successfully',
            'data' => $products
        ]);
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        
        // Tambahkan gambar untuk setiap kategori
        $categories->transform(function ($category) {
            $category->image_url = ProductImageHelper::getImageUrl($category->name, $category->name);
            return $category;
        });
        
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories
        ]);
    }
}