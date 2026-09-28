@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Pesanan Saya</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pesanan #{{ $order->order_number }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <!-- Status Timeline -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Status Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="text-center {{ in_array($order->status, ['pending', 'paid', 'processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['pending', 'paid', 'processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">1</div>
                                <div class="mt-2">Menunggu<br>Pembayaran</div>
                                @if($order->status == 'pending' && $order->payment_status == 'pending')
                                <small class="text-primary">(Saat ini)</small>
                                @endif
                            </div>
                            <div class="text-center {{ in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">2</div>
                                <div class="mt-2">Pembayaran<br>Diterima</div>
                                @if($order->status == 'paid')
                                <small class="text-primary">(Saat ini)</small>
                                @endif
                            </div>
                            <div class="text-center {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">3</div>
                                <div class="mt-2">Diproses</div>
                                @if($order->status == 'processing')
                                <small class="text-primary">(Saat ini)</small>
                                @endif
                            </div>
                            <div class="text-center {{ in_array($order->status, ['shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">4</div>
                                <div class="mt-2">Dikirim</div>
                                @if($order->status == 'shipped')
                                <small class="text-primary">(Saat ini)</small>
                                @endif
                            </div>
                            <div class="text-center {{ $order->status == 'delivered' ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ $order->status == 'delivered' ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">5</div>
                                <div class="mt-2">Selesai</div>
                                @if($order->status == 'delivered')
                                <small class="text-primary">(Selesai)</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Detail Produk</h5>
                </div>
                <div class="card-body">
                    @foreach($order->items as $item)
                    <div class="row mb-3">
                        <div class="col-md-2">
                            @if($item->product && $item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="img-fluid rounded" style="max-height: 80px;">
                            @else
                            <div style="font-size: 40px; text-align: center;">📦</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h6>{{ $item->product_name }}</h6>
                            <p class="text-muted mb-0">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            @if($order->status == 'delivered' && !$order->reviews->where('product_id', $item->product_id)->first())
                            <br>
                            <a href="{{ route('reviews.create', [$order->id, $item->product_id]) }}" class="btn btn-sm btn-outline-primary mt-2">Beri Ulasan</a>
                            @endif
                        </div>
                    </div>
                    @if(!$loop->last)
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>

            <!-- Info Pengiriman -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengiriman</h5>
                </div>
                <div class="card-body">
                    <p><strong>Alamat:</strong><br>{{ $order->shipping_address }}</p>
                    <p><strong>Kurir:</strong> {{ strtoupper($order->shipping_courier) }} - {{ $order->shipping_service }}</p>
                    <p><strong>Ongkos Kirim:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                    @if($order->tracking_number)
                    <p>
                        <strong>Nomor Resi:</strong> {{ $order->tracking_number }}
                        <br>
                        <a href="https://cekresi.com/?noresi={{ $order->tracking_number }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Lacak Pengiriman</a>
                    </p>
                    @endif
                    @if($order->notes)
                    <p><strong>Catatan:</strong> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Ringkasan Pembayaran -->
            <div class="card mb-3">
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
                        @if($order->discount > 0)
                        <tr>
                            <td>Diskon</td>
                            <td class="text-end text-success">- Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Total</strong></td>
                            <td class="text-end"><strong class="text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>

                    <hr>

                    <p><strong>Metode Pembayaran:</strong> {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Status Pembayaran:</strong>
                        @if($order->payment_status == 'paid')
                        <span class="badge bg-success">Lunas</span>
                        @else
                        <span class="badge bg-warning">Belum Dibayar</span>
                        @endif
                    </p>
                    <p><strong>Status Pesanan:</strong> <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span></p>
                    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>

                    @if($order->paid_at)
                    <p><strong>Tanggal Bayar:</strong> {{ $order->paid_at->format('d M Y H:i') }}</p>
                    @endif

                    @if($order->shipped_at)
                    <p><strong>Tanggal Kirim:</strong> {{ $order->shipped_at->format('d M Y H:i') }}</p>
                    @endif

                    @if($order->delivered_at)
                    <p><strong>Tanggal Selesai:</strong> {{ $order->delivered_at->format('d M Y H:i') }}</p>
                    @endif

                    <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-secondary w-100 mt-2 mb-3" target="_blank">
                        <i class="fas fa-download"></i> Download Invoice
                    </a>

                    <!-- Tombol Aksi Berdasarkan Status -->
                    @if($order->status == 'pending' && $order->payment_status == 'pending')
                    <a href="{{ route('orders.payment', $order->id) }}" class="btn btn-primary w-100 mb-2">Bayar Sekarang</a>
                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Batalkan pesanan?')">Batalkan Pesanan</button>
                    </form>

                    @elseif($order->status == 'paid' || $order->status == 'processing')
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Pesanan sedang diproses
                    </div>

                    @elseif($order->status == 'shipped')
                    <form action="{{ route('orders.received', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100" onclick="return confirm('Konfirmasi bahwa Anda telah menerima barang?')">
                            Konfirmasi Penerimaan
                        </button>
                    </form>

                    @elseif($order->status == 'delivered')
                    <div class="alert alert-success text-center">
                        <i class="fas fa-check-circle"></i> Pesanan Selesai
                    </div>
                    @php
                    $reviewCount = $order->reviews->count();
                    $itemCount = $order->items->count();
                    @endphp
                    @if($reviewCount < $itemCount)
                        <div class="alert alert-warning mt-2">
                        <i class="fas fa-star"></i> Anda belum memberikan ulasan untuk {{ $itemCount - $reviewCount }} produk
                </div>
                @else
                <div class="alert alert-info mt-2">
                    <i class="fas fa-check"></i> Terima kasih telah memberikan ulasan
                </div>
                @endif

                @elseif($order->status == 'cancelled')
                <div class="alert alert-danger text-center">
                    <i class="fas fa-times-circle"></i> Pesanan Dibatalkan
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection