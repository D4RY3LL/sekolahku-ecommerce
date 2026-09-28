@extends('layouts.app')

@section('title', 'Cara Belanja - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Cara Belanja</li>
        </ol>
    </nav>

    <h1 class="mb-4">Cara Belanja di SekolahKu</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Langkah-Langkah Berbelanja</h4>
                    
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">1</span>
                        </div>
                        <div>
                            <h5>Cari Produk</h5>
                            <p>Gunakan fitur pencarian atau telusuri kategori produk yang Anda inginkan. Anda juga bisa menggunakan filter untuk mempersempit pencarian.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">2</span>
                        </div>
                        <div>
                            <h5>Pilih Produk</h5>
                            <p>Klik produk yang Anda inginkan untuk melihat detail. Tentukan jumlah yang ingin dibeli, lalu klik "Tambah ke Keranjang".</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">3</span>
                        </div>
                        <div>
                            <h5>Keranjang Belanja</h5>
                            <p>Periksa kembali produk yang Anda pilih di halaman keranjang. Anda bisa mengubah jumlah atau menghapus produk jika diperlukan.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">4</span>
                        </div>
                        <div>
                            <h5>Checkout</h5>
                            <p>Masukkan alamat pengiriman, pilih metode pengiriman dan pembayaran. Periksa kembali total belanja Anda.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">5</span>
                        </div>
                        <div>
                            <h5>Pembayaran</h5>
                            <p>Lakukan pembayaran sesuai metode yang Anda pilih. Transfer ke rekening kami dan konfirmasi pembayaran.</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <span class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">6</span>
                        </div>
                        <div>
                            <h5>Terima Pesanan</h5>
                            <p>Pesanan akan diproses dan dikirim. Anda bisa melacak status pesanan di halaman "Pesanan Saya".</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Butuh Bantuan?</h5>
                </div>
                <div class="card-body">
                    <p>Jika Anda mengalami kesulitan, silakan hubungi kami:</p>
                    <p><i class="fas fa-phone me-2"></i> 0812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i> info@sekolahku.com</p>
                    <p><i class="fas fa-clock me-2"></i> Senin - Sabtu: 08.00 - 17.00</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary w-100">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection