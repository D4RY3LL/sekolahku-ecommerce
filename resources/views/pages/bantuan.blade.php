@extends('layouts.app')

@section('title', 'Pusat Bantuan - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Pusat Bantuan</li>
        </ol>
    </nav>

    <h1 class="mb-4">Pusat Bantuan</h1>

    <div class="row">
        <div class="col-md-8">
            <!-- Search Help -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" 
                                   placeholder="Cari pertanyaan...">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="accordion" id="helpAccordion">
                <!-- Akun & Login -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#akun">
                            <i class="fas fa-user-circle me-2 text-primary"></i>
                            Akun & Login
                        </button>
                    </h2>
                    <div id="akun" class="accordion-collapse collapse show" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    Bagaimana cara membuat akun?
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Lupa password?
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Cara mengubah data profil
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Verifikasi email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Belanja -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#belanja">
                            <i class="fas fa-shopping-cart me-2 text-success"></i>
                            Cara Belanja
                        </button>
                    </h2>
                    <div id="belanja" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="{{ route('cara-belanja') }}" class="list-group-item list-group-item-action">
                                    Langkah-langkah berbelanja
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Cara menambahkan ke keranjang
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Mengubah jumlah pesanan
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Menghapus item dari keranjang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pembayaran">
                            <i class="fas fa-credit-card me-2 text-warning"></i>
                            Pembayaran
                        </button>
                    </h2>
                    <div id="pembayaran" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="{{ route('pembayaran') }}" class="list-group-item list-group-item-action">
                                    Metode pembayaran
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Cara konfirmasi pembayaran
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Pembayaran COD
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Transfer bank
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengiriman -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengiriman">
                            <i class="fas fa-truck me-2 text-info"></i>
                            Pengiriman
                        </button>
                    </h2>
                    <div id="pengiriman" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="{{ route('pengiriman') }}" class="list-group-item list-group-item-action">
                                    Informasi pengiriman
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Cara melacak pesanan
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Gratis ongkir
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Estimasi waktu pengiriman
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengembalian -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pengembalian">
                            <i class="fas fa-undo-alt me-2 text-danger"></i>
                            Pengembalian Barang
                        </button>
                    </h2>
                    <div id="pengembalian" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                            <div class="list-group">
                                <a href="{{ route('pengembalian') }}" class="list-group-item list-group-item-action">
                                    Kebijakan pengembalian
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Cara mengajukan pengembalian
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Syarat pengembalian
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    Refund dana
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Kontak Cepat -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-headset me-2"></i>Kontak Cepat</h5>
                </div>
                <div class="card-body">
                    <p><i class="fab fa-whatsapp text-success me-2"></i> <strong>WhatsApp:</strong> 0812-3456-7890</p>
                    <p><i class="fas fa-phone text-primary me-2"></i> <strong>Telepon:</strong> (021) 1234-5678</p>
                    <p><i class="fas fa-envelope text-danger me-2"></i> <strong>Email:</strong> cs@sekolahku.com</p>
                    <hr>
                    <p><i class="fas fa-clock text-warning me-2"></i> <strong>Jam Operasional:</strong><br>
                    Senin - Jumat: 08.00 - 17.00<br>
                    Sabtu: 08.00 - 14.00</p>
                </div>
            </div>

            <!-- Artikel Bantuan -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i>Artikel Terbaru</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">Tips aman berbelanja online</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">Cara menghindari penipuan</a>
                        </li>
                        <li class="mb-2">
                            <a href="#" class="text-decoration-none">Memilih produk berkualitas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection