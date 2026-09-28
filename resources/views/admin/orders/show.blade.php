@extends('layouts.admin')

@section('title', 'Detail Pesanan - Admin SekolahKu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Pesanan #{{ $order->order_number }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Status Pesanan -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Update Status Pesanan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-control" name="status">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Pembayaran Diterima</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="tracking_number" 
                                       placeholder="Nomor Resi" value="{{ $order->tracking_number }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Update Status</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Detail Produk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Informasi Customer -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Customer</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $order->user->name }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                    <p><strong>No. HP:</strong> {{ $order->user->phone }}</p>
                </div>
            </div>

            <!-- Informasi Pengiriman -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <p><strong>Alamat:</strong> {{ $order->shipping_address }}</p>
                    <p><strong>Kurir:</strong> {{ strtoupper($order->shipping_courier) }}</p>
                    <p><strong>Layanan:</strong> {{ $order->shipping_service }}</p>
                    <p><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                    @if($order->tracking_number)
                        <p><strong>Resi:</strong> {{ $order->tracking_number }}</p>
                    @endif
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Pembayaran</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Ongkos Kirim</td>
                            <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td class="text-end"><strong>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>
                    <p><strong>Metode Pembayaran:</strong> {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Status Pembayaran:</strong> 
                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->payment_status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection