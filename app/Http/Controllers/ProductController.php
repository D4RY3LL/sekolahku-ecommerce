<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        // Filter berdasarkan kata kunci
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Filter berdasarkan merek
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        
        // Filter berdasarkan harga
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Filter produk promo
        if ($request->has('promo')) {
            $query->whereNotNull('old_price')
                  ->where('old_price', '>', 'price');
        }
        
        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'best_seller':
                $query->orderBy('sold_count', 'desc');
                break;
            case 'promo':
                $query->whereNotNull('old_price')
                      ->where('old_price', '>', 'price')
                      ->orderByRaw('((old_price - price) / old_price) DESC');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->latest();
                break;
        }
        
        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        $brands = Product::distinct('brand')->pluck('brand');
        
        return view('products.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Halaman produk terlaris
     */
    public function bestSellers()
    {
        $products = Product::where('sold_count', '>', 0)
                          ->orderBy('sold_count', 'desc')
                          ->paginate(12);
        
        $categories = Category::withCount('products')->get();
        $brands = Product::distinct('brand')->pluck('brand');
        
        return view('products.index', compact('products', 'categories', 'brands'))
            ->with('title', 'Produk Terlaris');
    }

    /**
     * Halaman produk promo
     */
    public function promo()
    {
        $products = Product::whereNotNull('old_price')
                          ->where('old_price', '>', 'price')
                          ->orderByRaw('((old_price - price) / old_price) DESC')
                          ->paginate(12);
        
        $categories = Category::withCount('products')->get();
        $brands = Product::distinct('brand')->pluck('brand');
        
        return view('products.index', compact('products', 'categories', 'brands'))
            ->with('title', 'Produk Promo');
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'reviews.user', 'images'])
                         ->where('slug', $slug)
                         ->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
                                 ->where('id', '!=', $product->id)
                                 ->limit(4)
                                 ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function getByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->paginate(12);
        
        return view('products.category', compact('category', 'products'));
    }
}