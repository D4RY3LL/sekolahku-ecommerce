@extends('layouts.app')

@section('title', 'Tracking Pesanan #' . $order->order_number . ' - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('lacak-pesanan') }}">Lacak Pesanan</a></li>
            <li class="breadcrumb-item active">#{{ $order->order_number }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-truck me-2"></i>Status Pengiriman</h5>
                </div>
                <div class="card-body">
                    <!-- Status Timeline -->
                    <div class="timeline mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="text-center {{ in_array($order->status, ['pending', 'paid', 'processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['pending', 'paid', 'processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    1
                                </div>
                                <div class="mt-2 small">Pesanan Dibuat</div>
                                <small>{{ $order->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="text-center {{ in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['paid', 'processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    2
                                </div>
                                <div class="mt-2 small">Pembayaran</div>
                                @if($order->paid_at)
                                    <small>{{ $order->paid_at->format('d/m/Y H:i') }}</small>
                                @endif
                            </div>
                            <div class="text-center {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    3
                                </div>
                                <div class="mt-2 small">Diproses</div>
                            </div>
                            <div class="text-center {{ in_array($order->status, ['shipped', 'delivered']) ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ in_array($order->status, ['shipped', 'delivered']) ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    4
                                </div>
                                <div class="mt-2 small">Dikirim</div>
                                @if($order->shipped_at)
                                    <small>{{ $order->shipped_at->format('d/m/Y H:i') }}</small>
                                @endif
                            </div>
                            <div class="text-center {{ $order->status == 'delivered' ? 'text-primary' : 'text-muted' }}">
                                <div class="rounded-circle bg-{{ $order->status == 'delivered' ? 'primary' : 'secondary' }} text-white d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    5
                                </div>
                                <div class="mt-2 small">Selesai</div>
                                @if($order->delivered_at)
                                    <small>{{ $order->delivered_at->format('d/m/Y H:i') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Status:</strong> 
                        <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span>
                    </div>

                    @if($order->tracking_number)
                    <div class="mt-3 p-3 bg-light rounded">
                        <h6><i class="fas fa-box-open me-2"></i>Nomor Resi:</h6>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $order->tracking_number }}" readonly>
                            <button class="btn btn-outline-primary" type="button" onclick="copyResi()">
                                <i class="fas fa-copy"></i>
                            </button>
                            <a href="https://cekresi.com/?noresi={{ $order->tracking_number }}" 
                               target="_blank" class="btn btn-primary">
                                <i class="fas fa-external-link-alt"></i> Lacak di Kurir
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>Detail Pesanan</h5>
                </div>
                <div class="card-body">
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

        <div class="col-md-4">
            <!-- Informasi Pengiriman -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-truck me-2"></i>Info Pengiriman</h5>
                </div>
                <div class="card-body">
                    <p><strong>Kurir:</strong> {{ strtoupper($order->shipping_courier) }} - {{ $order->shipping_service }}</p>
                    <p><strong>Ongkir:</strong> Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                    <p><strong>Alamat:</strong><br>{{ $order->shipping_address }}</p>
                </div>
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Pembayaran</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Ongkir</td>
                            <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td class="text-end"><strong>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
                        </tr>
                    </table>
                    <p><strong>Metode:</strong> {{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->payment_status == 'paid' ? 'Lunas' : 'Belum Dibayar' }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function copyResi() {
    var resi = '{{ $order->tracking_number }}';
    navigator.clipboard.writeText(resi).then(function() {
        alert('Nomor resi berhasil disalin!');
    });
}
</script>
@endpush
@endsection