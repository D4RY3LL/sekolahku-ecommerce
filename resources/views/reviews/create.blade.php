@extends('layouts.app')

@section('title', 'Beri Ulasan - SekolahKu')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Beri Ulasan Produk</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: cover;" class="rounded me-3">
                        @else
                            <div style="font-size: 50px;" class="me-3">📦</div>
                        @endif
                        <div>
                            <h6>{{ $product->name }}</h6>
                            <p class="text-muted mb-0">Dari pesanan #{{ $order->order_number }}</p>
                        </div>
                    </div>

                    <form action="{{ route('reviews.store', [$order->id, $product->id]) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating">
                                <div class="btn-group" role="group">
                                    @for($i = 1; $i <= 5; $i++)
                                    <input type="radio" class="btn-check" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                    <label class="btn btn-outline-warning" for="star{{ $i }}">{{ $i }} ★</label>
                                    @endfor
                                </div>
                            </div>
                            @error('rating')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Ulasan</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                      id="comment" name="comment" rows="5" 
                                      placeholder="Bagaimana pendapat Anda tentang produk ini?" required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection