@extends('layouts.app')

@section('title', $post['title'] . ' - Blog SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
            <li class="breadcrumb-item active">{{ $post['title'] }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <article class="blog-post">
                <h1 class="mb-3">{{ $post['title'] }}</h1>
                
                <div class="text-muted mb-4">
                    <i class="far fa-calendar"></i> {{ date('d F Y', strtotime($post['date'])) }}
                    <i class="far fa-user ms-3"></i> {{ $post['author'] }}
                </div>

                <div class="blog-content">
                    {!! $post['content'] !!}
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Blog
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        Belanja Sekarang
                    </a>
                </div>
            </article>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Kategori</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('blog.index') }}" class="text-decoration-none">Semua Artikel</a></li>
                        <li><a href="{{ route('products.index', ['sort' => 'best_seller']) }}" class="text-decoration-none">Produk Terlaris</a></li>
                        <li><a href="{{ route('products.index', ['is_featured' => 1]) }}" class="text-decoration-none">Promo</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection