@extends('layouts.app')

@section('title', 'Beranda - SekolahKu')

@push('scripts')
<script src="{{ asset('js/product-show.js') }}"></script>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 style="font-size: 48px; margin-bottom: 20px;">Lengkapi Kebutuhan Sekolah Anda</h1>
                <p style="font-size: 18px; margin-bottom: 30px; opacity: 0.95;">Dapatkan berbagai perlengkapan sekolah berkualitas dengan harga terbaik. Gratis ongkir untuk pembelian di atas Rp 100.000!</p>
                <a href="{{ route('products.index') }}" class="btn btn-light btn-lg" style="color: #667eea; font-weight: bold;">Belanja Sekarang</a>
            </div>
            <div class="col-md-6 text-center">
                <div style="font-size: 200px;">📚</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories" style="padding: 60px 0; background: white;">
    <div class="container">
        <h2 class="text-center" style="font-size: 36px; margin-bottom: 40px; color: #333;">Kategori Produk</h2>
        <div class="row g-4">
            @foreach($categories as $category)
            <div class="col-md-4 col-lg-2">
                <a href="{{ route('products.category', $category->slug) }}" class="text-decoration-none">
                    <div class="category-card" style="background: white; border: 2px solid #e0e0e0; border-radius: 15px; padding: 30px; text-align: center; transition: all 0.3s;">
                        <div style="font-size: 50px; margin-bottom: 15px;">{{ $category->icon }}</div>
                        <h3 style="font-size: 18px; color: #333; margin-bottom: 5px;">{{ $category->name }}</h3>
                        <p style="font-size: 14px; color: #666;">{{ $category->products_count }} Produk</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section class="products" style="padding: 60px 0; background: #f8f9fa;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="font-size: 36px; color: #333;">🔥 Produk Terlaris</h2>
            <a href="{{ route('products.best-sellers') }}" class="btn btn-outline-primary">Lihat Semua</a>
        </div>

        @if($bestSellers->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada produk terlaris
        </div>
        @else
        <div class="row g-4">
            @foreach($bestSellers as $product)
            <div class="col-md-6 col-lg-3">
                <div class="product-card" data-url="{{ route('products.show', $product->slug) }}" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: all 0.3s; cursor: pointer;">
                    <div class="product-image" style="width: 100%; height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; font-size: 80px; position: relative;">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                        <span style="font-size: 80px;">📦</span>
                        @endif
                        <span class="product-badge" style="position: absolute; top: 10px; right: 10px; background: #ff5722; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">
                            Terjual {{ $product->sold_count }}
                        </span>
                    </div>
                    <div class="product-info" style="padding: 20px;">
                        <div class="product-name" style="font-size: 16px; font-weight: 600; margin-bottom: 10px; color: #333;">{{ $product->name }}</div>
                        <div class="product-rating" style="color: #ffa502; margin-bottom: 10px; font-size: 14px;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <=round($product->rating))
                                ★
                                @else
                                ☆
                                @endif
                                @endfor
                                ({{ number_format($product->rating, 1) }})
                        </div>
                        <div class="product-price" style="font-size: 22px; font-weight: bold; color: #667eea; margin-bottom: 15px;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            @if($product->old_price)
                            <span class="old-price" style="font-size: 16px; color: #999; text-decoration: line-through; margin-left: 10px;">Rp {{ number_format($product->old_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <form action="{{ route('cart.add', $product) }}" method="POST" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-to-cart" style="width: 100%; padding: 12px; background: #667eea; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.3s;">+ Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Promo Products Section -->
<section class="products" style="padding: 60px 0; background: white;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="font-size: 36px; color: #333;">🎉 Promo Spesial</h2>
            <a href="{{ route('products.promo') }}" class="btn btn-outline-primary">Lihat Semua Promo</a>
        </div>

        @if($promoProducts->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada produk promo
        </div>
        @else
        <div class="row g-4">
            @foreach($promoProducts as $product)
            <div class="col-md-6 col-lg-3">
                <div class="product-card" data-url="{{ route('products.show', $product->slug) }}"
                    style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

                    <!-- Gambar dan Info Produk -->
                    <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                        <div class="product-image" style="height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; position: relative;">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                            <span style="font-size: 80px;">📦</span>
                            @endif

                            <!-- Badge -->
                            @if($product->discount_percentage > 0)
                            <span class="product-badge" style="position: absolute; top: 10px; right: 10px; background: #ff4757; color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; font-weight: bold;">
                                -{{ $product->discount_percentage }}%
                            </span>
                            @endif
                        </div>
                        <div class="product-info" style="padding: 20px;">
                            <div class="product-name" style="font-size: 16px; font-weight: 600;">{{ $product->name }}</div>
                            <div class="product-price" style="font-size: 22px; font-weight: bold; color: #667eea;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </a>

                    <!-- Tombol Aksi -->
                    <div class="px-3 pb-3 d-flex gap-2">
                        <!-- Form Wishlist -->
                        @auth
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="flex-grow-1" onclick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="far fa-heart"></i>
                            </button>
                        </form>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-danger flex-grow-1" onclick="event.stopPropagation()">
                            <i class="far fa-heart"></i>
                        </a>
                        @endauth

                        <!-- Form Cart -->
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow-1" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Promo Banner -->
<section class="promo-banner" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 50px 0; color: white; text-align: center;">
    <div class="container">
        <h2 style="font-size: 36px; margin-bottom: 15px;">🎉 Promo Back to School!</h2>
        <p style="font-size: 18px; margin-bottom: 25px;">Dapatkan diskon hingga 50% untuk semua perlengkapan sekolah</p>
        <a href="{{ route('products.promo') }}" class="btn btn-light btn-lg" style="color: #667eea; font-weight: bold;">Lihat Semua Promo</a>
    </div>
</section>

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