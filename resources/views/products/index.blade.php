@extends('layouts.app')

@section('title', isset($title) ? $title . ' - SekolahKu' : 'Produk - SekolahKu')

@section('content')
@php
    use App\Helpers\ProductImageHelper;
@endphp
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-3 rounded">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produk</li>
            @if(isset($title))
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            @endif
        </ol>
    </nav>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" id="filter-form">
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label class="fw-bold text-primary mb-2">Kategori</label>
                            @foreach($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category"
                                    value="{{ $category->id }}"
                                    id="cat{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="cat{{ $category->id }}">
                                    {{ $category->name }} <span class="text-muted">({{ $category->products_count }})</span>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Merek -->
                        <div class="mb-4">
                            <label class="fw-bold text-primary mb-2">Merek</label>
                            <select name="brand" class="form-select">
                                <option value="">Semua Merek</option>
                                @foreach($brands as $brand)
                                @if($brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="mb-4">
                            <label class="fw-bold text-primary mb-2">Rentang Harga</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-control"
                                        placeholder="Min" value="{{ request('min_price') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-control"
                                        placeholder="Max" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Urutkan -->
                        <div class="mb-4">
                            <label class="fw-bold text-primary mb-2">Urutkan</label>
                            <select name="sort" class="form-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                <option value="best_seller" {{ request('sort') == 'best_seller' ? 'selected' : '' }}>Best Seller</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-search me-2"></i>Terapkan Filter
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-undo me-2"></i>Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9">
            <!-- Info Bar -->
            <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded mb-4">
                <h4 class="mb-0 text-primary">{{ isset($title) ? $title : 'Semua Produk' }}</h4>
                <span class="text-muted">
                    <i class="fas fa-box me-1"></i>
                    Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                </span>
            </div>

            @if($products->isEmpty())
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-box-open fa-4x text-primary mb-3"></i>
                <h4 class="fw-bold">Produk Tidak Ditemukan</h4>
                <p class="text-muted">Maaf, tidak ada produk yang sesuai dengan kriteria pencarian Anda.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-undo me-2"></i>Lihat Semua Produk
                </a>
            </div>
            @else
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm product-card" data-url="{{ route('products.show', $product->slug) }}" style="cursor: pointer; transition: transform 0.2s;">
                        <!-- Gambar Produk -->
                        <div class="position-relative" style="height: 200px; overflow: hidden; background: #f8f9fa;">
                            @if($product->image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="card-img-top"
                                style="height: 100%; width: 100%; object-fit: cover;"
                                onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                            @else
                            @php
                            $defaultImages = [
                            'Buku Tulis' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop',
                            'Alat Tulis' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300&h=300&fit=crop',
                            'Alat Gambar' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=300&h=300&fit=crop',
                            'Tas Sekolah' => 'https://images.unsplash.com/photo-1622560480605-d6c1c4e3d0f0?w=300&h=300&fit=crop',
                            'Seragam' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=300&h=300&fit=crop',
                            'Perlengkapan' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504?w=300&h=300&fit=crop',
                            ];
                            $categoryName = $product->category->name ?? 'Buku Tulis';
                            $imageUrl = $defaultImages[$categoryName] ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop';
                            @endphp
                            <img src="{{ $imageUrl }}"
                                alt="{{ $product->name }}"
                                class="card-img-top"
                                style="height: 100%; width: 100%; object-fit: cover;">
                            @endif

                            <!-- Badges -->
                            @if($product->discount_percentage > 0)
                            <span class="position-absolute top-0 start-0 badge bg-danger m-2 p-2">
                                <i class="fas fa-tag me-1"></i>-{{ $product->discount_percentage }}%
                            </span>
                            @endif

                            @if($product->is_best_seller)
                            <span class="position-absolute top-0 end-0 badge bg-warning text-dark m-2 p-2">
                                <i class="fas fa-fire me-1"></i>Best Seller
                            </span>
                            @endif
                        </div>

                        <!-- Info Produk -->
                        <div class="card-body">
                            <h6 class="card-title fw-bold mb-2" style="height: 48px; overflow: hidden;">
                                {{ $product->name }}
                            </h6>

                            <!-- Rating -->
                            <div class="mb-2 text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <=round($product->rating))
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                    @endfor
                                    <span class="text-muted ms-1">({{ number_format($product->rating, 1) }})</span>
                            </div>

                            <!-- Harga -->
                            <div class="mb-3">
                                <span class="h5 fw-bold text-primary">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if($product->old_price)
                                <small class="text-muted text-decoration-line-through ms-2">
                                    Rp {{ number_format($product->old_price, 0, ',', '.') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="card-footer bg-white border-0 pb-3 pt-0">
                            <div class="d-flex gap-2">
                                <!-- Wishlist Button -->
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

                                <!-- Cart Button -->
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow-1" onclick="event.stopPropagation()">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-1"></i>Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Custom Pagination -->
            @if ($products->hasPages())
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 gap-3">

                <!-- Info -->
                <div class="text-muted small">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </div>

                <!-- Pagination -->
                <nav>
                    <ul class="custom-pagination d-flex align-items-center gap-2 list-unstyled mb-0">

                        <!-- Previous -->
                        @if ($products->onFirstPage())
                        <li class="disabled">
                            <span class="page-btn">&lsaquo;</span>
                        </li>
                        @else
                        <li>
                            <a href="{{ $products->previousPageUrl() }}" class="page-btn">&lsaquo;</a>
                        </li>
                        @endif

                        <!-- Page Numbers -->
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li>
                                <a href="{{ $products->url($i) }}"
                                    class="page-btn {{ $products->currentPage() == $i ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            </li>
                            @endfor

                            <!-- Next -->
                            @if ($products->hasMorePages())
                            <li>
                                <a href="{{ $products->nextPageUrl() }}" class="page-btn">&rsaquo;</a>
                            </li>
                            @else
                            <li class="disabled">
                                <span class="page-btn">&rsaquo;</span>
                            </li>
                            @endif

                    </ul>
                </nav>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>

<style>
    .product-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.2) !important;
        border-color: transparent !important;
    }

    .product-card .btn {
        transition: all 0.2s;
    }

    .product-card .btn:hover {
        transform: translateY(-2px);
    }

    /* Custom Pagination */
    .custom-pagination .page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #fff;
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .custom-pagination .page-btn:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #4338ca;
    }

    .custom-pagination .active {
        background: #667eea;
        color: #fff !important;
        border-color: #667eea;
        box-shadow: 0 6px 16px rgba(102, 126, 234, 0.35);
    }

    .custom-pagination .disabled .page-btn {
        color: #cbd5e1;
        background: #f8fafc;
        pointer-events: none;
    }
</style>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto submit form saat filter berubah
        document.querySelectorAll('#filter-form select, #filter-form input[type=radio]').forEach(function(element) {
            element.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });

        // Product card click handler
        document.querySelectorAll('.product-card').forEach(function(card) {
            card.addEventListener('click', function(e) {
                if (e.target.tagName === 'FORM' || e.target.tagName === 'BUTTON' || e.target.tagName === 'INPUT' || e.target.closest('form')) {
                    return;
                }
                var url = this.dataset.url;
                if (url) {
                    window.location = url;
                }
            });
        });
    });
</script>
@endpush