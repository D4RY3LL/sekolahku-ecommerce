@extends('layouts.app')

@section('title', 'Daftar Merek - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Merek</li>
        </ol>
    </nav>

    <h2 class="mb-4">Daftar Merek</h2>

    <div class="row">
        @foreach($brands as $brand)
        <div class="col-md-3 mb-3">
            <a href="{{ route('products.index', ['brand' => $brand->brand]) }}" class="text-decoration-none">
                <div class="card h-100 text-center p-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $brand->brand }}</h5>
                        <p class="text-muted">{{ $brand->product_count }} Produk</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection