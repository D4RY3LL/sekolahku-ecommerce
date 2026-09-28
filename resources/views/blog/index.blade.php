@extends('layouts.app')

@section('title', 'Blog - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Blog</li>
        </ol>
    </nav>

    <h2 class="mb-4">Blog SekolahKu</h2>
    <p class="text-muted mb-5">Tips dan informasi seputar perlengkapan sekolah dan dunia pendidikan</p>

    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="blog-image" style="height: 100%; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 60px;">📝</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post['title'] }}</h5>
                            <p class="card-text text-muted small">
                                <i class="far fa-calendar"></i> {{ date('d M Y', strtotime($post['date'])) }}
                                <i class="far fa-user ms-3"></i> {{ $post['author'] }}
                            </p>
                            <p class="card-text">{{ $post['excerpt'] }}</p>
                            <a href="{{ route('blog.detail', $post['slug']) }}" class="btn btn-sm btn-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection