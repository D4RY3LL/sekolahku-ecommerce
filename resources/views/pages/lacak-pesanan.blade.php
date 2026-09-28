@extends('layouts.app')

@section('title', 'Lacak Pesanan - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Lacak Pesanan</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-search me-2"></i>Lacak Pesanan Anda</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="text-center mb-4">
                        <i class="fas fa-box-open fa-4x text-primary mb-3"></i>
                        <h5>Masukkan Nomor Pesanan Anda</h5>
                        <p class="text-muted">Nomor pesanan dapat ditemukan di email konfirmasi atau halaman pesanan Anda</p>
                    </div>

                    <form action="{{ route('lacak-pesanan.cari') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-9">
                                <input type="text" 
                                       class="form-control form-control-lg @error('order_number') is-invalid @enderror" 
                                       name="order_number" 
                                       placeholder="Contoh: INV202403081234"
                                       value="{{ old('order_number') }}"
                                       required>
                                @error('order_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-search"></i> Lacak
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center p-3">
                                <i class="fas fa-envelope fa-2x text-info mb-2"></i>
                                <h6>Cek Email</h6>
                                <p class="small text-muted">Nomor pesanan dikirim ke email Anda saat checkout</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center p-3">
                                <i class="fas fa-user-circle fa-2x text-success mb-2"></i>
                                <h6>Login ke Akun</h6>
                                <p class="small text-muted">Lihat semua pesanan Anda di halaman "Pesanan Saya"</p>
                                @auth
                                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">
                                        Lihat Pesanan Saya
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i>Pertanyaan Umum</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqLacak">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Di mana saya bisa menemukan nomor pesanan?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqLacak">
                                <div class="accordion-body">
                                    Nomor pesanan dapat ditemukan di:
                                    <ul>
                                        <li>Email konfirmasi pesanan</li>
                                        <li>Halaman "Pesanan Saya" jika Anda login</li>
                                        <li>Struk pembayaran jika Anda transfer</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Berapa lama pesanan diproses?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqLacak">
                                <div class="accordion-body">
                                    Pesanan diproses 1x24 jam setelah pembayaran dikonfirmasi. Untuk COD, pesanan diproses setelah admin mengkonfirmasi pesanan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Kenapa pesanan saya tidak muncul?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqLacak">
                                <div class="accordion-body">
                                    Kemungkinan penyebab:
                                    <ul>
                                        <li>Nomor pesanan salah</li>
                                        <li>Pesanan terlalu baru (butuh waktu sinkronisasi)</li>
                                        <li>Pembayaran belum dikonfirmasi</li>
                                    </ul>
                                    Hubungi customer service jika masalah berlanjut.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection