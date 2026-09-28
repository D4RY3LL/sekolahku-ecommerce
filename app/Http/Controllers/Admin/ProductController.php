<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products for ADMIN.
     */
    public function index(Request $request)
    {
        $products = Product::with('category')
                          ->latest()
                          ->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0|gt:price',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'sometimes|boolean',
            'is_best_seller' => 'sometimes|boolean',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'brand' => $request->brand,
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0|gt:price',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'brand' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'sometimes|boolean',
            'is_best_seller' => 'sometimes|boolean',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'brand' => $request->brand,
            'is_featured' => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}