@extends('layouts.app')

@section('title', 'Checkout - SekolahKu')

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.subtotal = {{ $subtotal }};
</script>
<script src="{{ asset('js/checkout.js') }}"></script>
@endpush

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                @csrf

                <!-- Alamat Pengiriman -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Alamat Pengiriman</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Metode Pengiriman -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Metode Pengiriman</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kurir</label>
                            <select class="form-select" name="shipping_courier" id="shipping_courier" required>
                                <option value="">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="sicepat">SiCepat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Layanan</label>
                            <select class="form-select" name="shipping_service" id="shipping_service" required disabled>
                                <option value="">Pilih Layanan</option>
                            </select>
                        </div>

                        <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Metode Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <select class="form-select" name="payment_method" required>
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="ewallet">E-Wallet (OVO, Gopay, Dana)</option>
                                <option value="cod">Cash On Delivery (COD)</option>
                                <option value="credit_card">Kartu Kredit</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan (Opsional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Contoh: Warna merah, size XL, dll"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ringkasan Pesanan</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }} ({{ $item->quantity }}x)</span>
                        <span>Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Ongkos Kirim</span>
                        <span class="fw-bold" id="display-shipping-cost">Rp 0</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="h5">Total</span>
                        <span class="h5 text-primary" id="grand-total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" form="checkout-form" class="btn btn-primary w-100">Buat Pesanan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection