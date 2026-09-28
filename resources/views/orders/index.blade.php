@extends('layouts.app')

@section('title', 'Pesanan Saya - SekolahKu')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Pesanan Saya</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center py-5">
            <h3>📦 Belum Ada Pesanan</h3>
            <p class="mb-3">Anda belum memiliki riwayat pesanan.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-3">
                <div class="list-group mb-4">
                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action active">
                        Semua Pesanan
                    </a>
                    <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="list-group-item list-group-item-action">
                        Menunggu Pembayaran
                    </a>
                    <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="list-group-item list-group-item-action">
                        Diproses
                    </a>
                    <a href="{{ route('orders.index', ['status' => 'shipped']) }}" class="list-group-item list-group-item-action">
                        Dikirim
                    </a>
                    <a href="{{ route('orders.index', ['status' => 'delivered']) }}" class="list-group-item list-group-item-action">
                        Selesai
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                @foreach($orders as $order)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <strong>No. Pesanan:</strong> {{ $order->order_number }}
                            <br>
                            <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                        </div>
                        <div>
                            <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h6 class="mb-0">{{ $item->product_name }}</h6>
                                <small class="text-muted">{{ $item->quantity }} x {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</small>
                            </div>
                            <span class="fw-bold">{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Total:</strong> {{ 'Rp ' . number_format($order->grand_total, 0, ',', '.') }}
                                <br>
                                <small class="text-muted">Metode Pembayaran: {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</small>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Detail Pesanan</a>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection