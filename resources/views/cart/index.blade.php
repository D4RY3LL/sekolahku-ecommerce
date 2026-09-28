@extends('layouts.app')

@section('title', 'Keranjang Belanja - SekolahKu')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if($cartItems->isEmpty())
        <div class="alert alert-info text-center py-5">
            <h3>🛒 Keranjang Belanja Kosong</h3>
            <p class="mb-3">Anda belum menambahkan produk apapun ke keranjang.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                @foreach($cartItems as $item)
                <div class="card mb-3 cart-item" id="cart-item-{{ $item->id }}">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid rounded">
                                @else
                                    <div class="text-center" style="font-size: 50px;">📦</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h5>{{ $item->product->name }}</h5>
                                <p class="text-muted mb-0">Stok: {{ $item->product->stock }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold text-primary">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update-cart-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" class="form-control quantity-input" 
                                           value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           data-cart-id="{{ $item->id }}"
                                           data-price="{{ $item->product->price }}">
                                </form>
                            </div>
                            <div class="col-md-2">
                                <span class="fw-bold subtotal" id="subtotal-{{ $item->id }}">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ms-2" onclick="return confirm('Hapus item dari keranjang?')">
                                        <i class="fas fa-trash"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ringkasan Belanja</h5>
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total Harga ({{ $cartItems->sum('quantity') }} barang)</span>
                            <span class="fw-bold" id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <hr>

                        <a href="{{ route('checkout') }}" class="btn btn-primary w-100 mb-2">Checkout</a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">Lanjut Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Auto submit saat quantity berubah
    $('.quantity-input').on('change', function() {
        $(this).closest('form').submit();
    });
});
</script>
@endpush
@endsection