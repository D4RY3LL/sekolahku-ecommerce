@extends('layouts.app')

@section('title', 'Wishlist Saya - SekolahKu')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Wishlist Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($wishlists->isEmpty())
        <div class="alert alert-info text-center py-5">
            <h3>❤️ Wishlist Kosong</h3>
            <p class="mb-3">Anda belum menambahkan produk apapun ke wishlist.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($wishlists as $wishlist)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <a href="{{ route('products.show', $wishlist->product->slug) }}" class="text-decoration-none text-dark">
                        <div class="product-image" style="height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            @if($wishlist->product->image)
                                <img src="{{ asset('storage/' . $wishlist->product->image) }}" alt="{{ $wishlist->product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <span style="font-size: 80px;">📦</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                            <p class="card-text text-primary fw-bold">Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}</p>
                            @if($wishlist->product->old_price)
                                <small class="text-muted text-decoration-line-through">Rp {{ number_format($wishlist->product->old_price, 0, ',', '.') }}</small>
                            @endif
                        </div>
                    </a>
                    <div class="card-footer bg-white d-flex justify-content-between">
                        <form action="{{ route('cart.add', $wishlist->product) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-shopping-cart"></i> Keranjang
                            </button>
                        </form>
                        <form action="{{ route('wishlist.remove', $wishlist) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus dari wishlist?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@push('scripts')
<script>
// Mencegah card terklik saat mengklik tombol
document.querySelectorAll('.product-card form, .product-card a.btn').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endpush
@endsection