<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function add(Product $product)
    {
        // Cek apakah sudah ada di wishlist
        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Produk sudah ada di wishlist');
        }

        // Tambah ke wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);

        return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist');
    }

    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->route('wishlist.index')
            ->with('success', 'Produk dihapus dari wishlist');
    }

    public static function count()
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', Auth::id())->count();
        }
        return 0;
    }
}
