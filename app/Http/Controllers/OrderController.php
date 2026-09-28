<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ALGORITMA CHECKOUT
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('orders.checkout', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_courier' => 'required|string',
            'shipping_service' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'payment_method' => 'required|in:transfer,ewallet,cod,credit_card',
            'notes' => 'nullable|string'
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang belanja Anda kosong');
        }

        // Validasi stok semua produk
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with(
                    'error',
                    "Stok {$item->product->name} tidak mencukupi. Tersedia: {$item->product->stock}"
                );
            }
        }

        DB::beginTransaction();

        try {
            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $grandTotal = $subtotal + $request->shipping_cost;

            // Buat nomor pesanan unik
            $orderNumber = Order::generateOrderNumber();

            // Simpan data pesanan
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $orderNumber,
                'total_amount' => $subtotal,
                'shipping_cost' => $request->shipping_cost,
                'grand_total' => $grandTotal,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_courier' => $request->shipping_courier,
                'shipping_service' => $request->shipping_service,
                'notes' => $request->notes
            ]);

            // Simpan item pesanan dan kurangi stok
            foreach ($cartItems as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity
                ]);

                // Kurangi stok produk
                $item->product->decrement('stock', $item->quantity);
                $item->product->increment('sold_count', $item->quantity);
            }

            // Kosongkan keranjang
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // Redirect sesuai metode pembayaran
            if (in_array($request->payment_method, ['transfer', 'ewallet'])) {
                return redirect()->route('orders.payment', $order->id)
                    ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
            }

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ALGORITMA TRACKING PESANAN
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat pesanannya sendiri
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Load relasi yang diperlukan
        $order->load('items.product', 'reviews');

        return view('orders.show', compact('order'));
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah pesanan sudah dibayar
        if ($order->payment_status === 'paid' || $order->status !== 'pending') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Pesanan ini sudah tidak memerlukan pembayaran');
        }

        return view('orders.payment', compact('order'));
    }

    public function confirmPayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah pesanan sudah dibayar
        if ($order->payment_status === 'paid') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Pesanan ini sudah dibayar');
        }

        // Update status pembayaran
        $order->update([
            'payment_status' => 'paid',
            'status' => 'paid',
            'paid_at' => now()
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Pesanan akan segera diproses.');
    }

    public function received(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah pesanan sudah diterima
        if ($order->status === 'delivered') {
            return redirect()->route('orders.show', $order->id)
                ->with('error', 'Pesanan ini sudah dikonfirmasi diterima');
        }

        // Konfirmasi penerimaan barang
        $order->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Terima kasih telah konfirmasi penerimaan barang');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Cek apakah pesanan bisa dibatalkan
        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses');
        }

        DB::transaction(function () use ($order) {
            // Kembalikan stok
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
                $item->product->decrement('sold_count', $item->quantity);
            }

            $order->update(['status' => 'cancelled']);
        });

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pesanan berhasil dibatalkan');
    }

    public static function generateOrderNumber()
    {
        $prefix = 'INV';
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count();

        return $prefix . $date . str_pad($lastOrder + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Download invoice PDF
     */
    public function downloadInvoice(Order $order)
    {
        if ($order->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $order->load('items.product', 'user');

        $pdf = Pdf::loadView('orders.invoice', compact('order'));

        return $pdf->download('Invoice-' . $order->order_number . '.pdf');
    }
}
