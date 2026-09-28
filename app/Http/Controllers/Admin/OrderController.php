<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%');
        }
        
        $orders = $query->latest()->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,delivered,cancelled',
            'tracking_number' => 'nullable|required_if:status,shipped|string'
        ]);

        $order->status = $request->status;
        
        if ($request->status === 'shipped') {
            $order->tracking_number = $request->tracking_number;
            $order->shipped_at = now();
        }
        
        if ($request->status === 'delivered') {
            $order->delivered_at = now();
        }
        
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}