<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller // Pastikan extends Controller
{
    public function create(Order $order, Product $product)
    {
        // Cek apakah order milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah produk ada di order dan order sudah selesai
        $orderItem = $order->items()->where('product_id', $product->id)->first();
        
        if (!$orderItem || $order->status !== 'delivered') {
            abort(403, 'Anda tidak dapat memberikan review untuk produk ini');
        }

        // Cek apakah sudah pernah review
        $existingReview = Review::where('user_id', Auth::id())
                               ->where('product_id', $product->id)
                               ->where('order_id', $order->id)
                               ->first();

        if ($existingReview) {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Anda sudah memberikan review untuk produk ini');
        }

        return view('reviews.create', compact('order', 'product'));
    }

    public function store(Request $request, Order $order, Product $product)
    {
        // Cek apakah order milik user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10'
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_id' => $order->id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        // Update rating produk
        $product->updateRating();

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Terima kasih atas review Anda');
    }
}