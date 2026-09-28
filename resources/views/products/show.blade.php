@extends('layouts.app')

@section('title', $product->name . ' - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body text-center">
                    @if($product->image)
                    <img id="main-image"
                        src="{{ \Illuminate\Support\Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid"
                        style="max-height: 400px;"
                        onerror="this.src='https://via.placeholder.com/600x600?text=No+Image'">
                    @else
                    @php
                    $defaultImages = [
                    'Buku Tulis' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&h=600&fit=crop',
                    'Alat Tulis' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=600&h=600&fit=crop',
                    'Alat Gambar' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=600&h=600&fit=crop',
                    'Tas Sekolah' => 'https://images.unsplash.com/photo-1622560480605-d6c1c4e3d0f0?w=600&h=600&fit=crop',
                    'Seragam' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=600&h=600&fit=crop',
                    'Perlengkapan' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504?w=600&h=600&fit=crop',
                    ];
                    $categoryName = $product->category->name ?? 'Buku Tulis';
                    $imageUrl = $defaultImages[$categoryName] ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&h=600&fit=crop';
                    @endphp
                    <img id="main-image" src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 400px;">
                    @endif
                </div>
            </div>

            @if($product->images->count() > 0)
            <div class="row mt-3">
                @foreach($product->images as $image)
                <div class="col-3">
                    @php
                    $thumbImage = \Illuminate\Support\Str::startsWith($image->image, 'http')
                    ? $image->image
                    : asset('storage/' . $image->image);
                    @endphp

                    <img src="{{ $thumbImage }}"
                        class="img-fluid rounded cursor-pointer"
                        alt="Product image"
                        style="cursor: pointer; height: 80px; width: 100%; object-fit: cover;"
                        onclick="gantiGambar('{{ $thumbImage }}')">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <h1 class="mb-3">{{ $product->name }}</h1>

            <div class="mb-3">
                <span class="badge bg-primary">{{ $product->category->name }}</span>
                <span class="badge bg-secondary">{{ $product->brand }}</span>
            </div>

            <div class="mb-3">
                <span class="text-warning h4">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <=round($product->rating))
                        ★
                        @else
                        ☆
                        @endif
                        @endfor
                </span>
                <span class="text-muted">({{ $product->reviews->count() }} ulasan)</span>
            </div>

            <div class="mb-4">
                @if($product->old_price)
                <span class="text-muted text-decoration-line-through h5">Rp {{ number_format($product->old_price, 0, ',', '.') }}</span>
                @endif
                <span class="text-primary h2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                @if($product->discount_percentage > 0)
                <span class="badge bg-danger ms-2">-{{ $product->discount_percentage }}%</span>
                @endif
            </div>

            <div class="mb-4">
                <span class="fw-bold">Stok: </span>
                @if($product->stock > 10)
                <span class="text-success">Tersedia ({{ $product->stock }})</span>
                @elseif($product->stock > 0)
                <span class="text-warning">Sisa {{ $product->stock }}</span>
                @else
                <span class="text-danger">Stok Habis</span>
                @endif
            </div>

            @if($product->stock > 0)
            <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="quantity" class="col-form-label fw-bold">Jumlah:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" style="width: 100px;">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-cart"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex gap-2">
                <!-- GANTI INI: pakai form biasa -->
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="far fa-heart"></i> Tambah ke Wishlist
                    </button>
                </form>

                <!-- GANTI INI: tombol share dengan fungsi simple -->
                <button class="btn btn-outline-secondary" onclick="shareProduk()">
                    <i class="fas fa-share-alt"></i> Bagikan
                </button>
            </div>

            <hr>

            <!-- Product Description -->
            <div class="mt-4">
                <h4>Deskripsi Produk</h4>
                <div class="text-muted">
                    {{ $product->description }}
                </div>
            </div>

            <div class="mt-4">
                <h4>Spesifikasi</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Merek</th>
                        <td>{{ $product->brand }}</td>
                    </tr>
                    <tr>
                        <th>Berat</th>
                        <td>{{ $product->weight }} gram</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Terjual</th>
                        <td>{{ $product->sold_count }} produk</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3>Ulasan Pembeli</h3>
            <hr>

            @if($product->reviews->isEmpty())
            <div class="alert alert-info text-center">
                Belum ada ulasan untuk produk ini.
            </div>
            @else
            <div class="row">
                @foreach($product->reviews as $review)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">{{ $review->user->name }}</h6>
                                    <div class="text-warning mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <=$review->rating)
                                            ★
                                            @else
                                            ☆
                                            @endif
                                            @endfor
                                    </div>
                                </div>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="card-text">{{ $review->comment }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
    <div class="row mt-5">
        <div class="col-12">
            <h3>Produk Terkait</h3>
            <hr>
            <div class="row g-4">
                @foreach($relatedProducts as $related)
                <div class="col-md-3">
                    <a href="{{ route('products.show', $related->slug) }}" style="text-decoration: none; color: inherit;">
                        <div class="card h-100">
                            @if($related->image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($related->image, 'http') ? $related->image : asset('storage/' . $related->image) }}"
                                class="card-img-top"
                                alt="{{ $related->name }}"
                                style="height: 150px; object-fit: cover;"
                                onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                            @else
                            @php
                            $relCategoryImages = [
                            'Buku Tulis' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop',
                            'Alat Tulis' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?w=300&h=300&fit=crop',
                            'Alat Gambar' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?w=300&h=300&fit=crop',
                            'Tas Sekolah' => 'https://images.unsplash.com/photo-1622560480605-d6c1c4e3d0f0?w=300&h=300&fit=crop',
                            'Seragam' => 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?w=300&h=300&fit=crop',
                            'Perlengkapan' => 'https://images.unsplash.com/photo-1523362628745-0c100150b504?w=300&h=300&fit=crop',
                            ];
                            $relCategoryName = $related->category->name ?? 'Buku Tulis';
                            $relImageUrl = $relCategoryImages[$relCategoryName] ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=300&h=300&fit=crop';
                            @endphp
                            <img src="{{ $relImageUrl }}" class="card-img-top" alt="{{ $related->name }}" style="height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $related->name }}</h6>
                                <p class="card-text text-primary fw-bold">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Fungsi simple untuk ganti gambar
    function gantiGambar(src) {
        document.getElementById('main-image').src = src;
    }

    // Fungsi simple untuk share
    function shareProduk() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $product->name }}',
                text: '{{ $product->description }}',
                url: window.location.href
            });
        } else {
            // Kalau gak support, tampilkan prompt
            prompt('Salin link ini:', window.location.href);
        }
    }
</script>
@endpush