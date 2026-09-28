@extends('layouts.app')

@section('title', $category->name . ' - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <h2 class="mb-4">Kategori: {{ $category->name }}</h2>

    @if($products->isEmpty())
        <div class="alert alert-info">
            Belum ada produk di kategori ini.
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-6 col-lg-3">
                <div class="product-card" data-url="{{ route('products.show', $product->slug) }}" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); cursor: pointer;">
                    <div class="product-image" style="height: 200px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span style="font-size: 80px;">📦</span>
                        @endif
                    </div>
                    <div class="product-info" style="padding: 20px;">
                        <div class="product-name" style="font-size: 16px; font-weight: 600;">{{ $product->name }}</div>
                        <div class="product-price" style="font-size: 22px; font-weight: bold; color: #667eea;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection