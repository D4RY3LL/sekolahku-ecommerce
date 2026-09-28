<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan keranjang
    public function index()
    {
        $cartItems = Cart::with('product')
                        ->where('user_id', Auth::id())
                        ->get();
        
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    // ALGORITMA TAMBAH KE KERANJANG
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Validasi jumlah ≤ stok
        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $product->stock);
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('user_id', Auth::id())
                       ->where('product_id', $product->id)
                       ->first();

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Total melebihi stok yang tersedia');
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Tambah item baru ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Update quantity - PERBAIKI INI
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        
        // Pastikan cart milik user yang login
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Validasi stok
        if ($request->quantity > $cart->product->stock) {
            return back()->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $cart->product->stock);
        }

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diupdate');
    }

    // Hapus item dari keranjang - PERBAIKI INI
    public function remove($id)
    {
        $cart = Cart::findOrFail($id);
        
        // Pastikan user hanya bisa hapus cart miliknya
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $cart->delete();
        
        return redirect()->route('cart.index')
            ->with('success', 'Item berhasil dihapus dari keranjang');
    }

    // Hitung jumlah item di keranjang
    public static function count()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }
        return 0;
    }
}