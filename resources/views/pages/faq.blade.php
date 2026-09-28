@extends('layouts.app')

@section('title', 'FAQ - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">FAQ</li>
        </ol>
    </nav>

    <h1 class="mb-4">Frequently Asked Questions</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <a href="#akun" class="list-group-item list-group-item-action">Akun</a>
                <a href="#pesanan" class="list-group-item list-group-item-action">Pesanan</a>
                <a href="#pembayaran" class="list-group-item list-group-item-action">Pembayaran</a>
                <a href="#pengiriman" class="list-group-item list-group-item-action">Pengiriman</a>
                <a href="#pengembalian" class="list-group-item list-group-item-action">Pengembalian</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card" id="akun">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Akun</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionAkun">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#akun1">
                                    Bagaimana cara membuat akun?
                                </button>
                            </h2>
                            <div id="akun1" class="accordion-collapse collapse show" data-bs-parent="#accordionAkun">
                                <div class="accordion-body">
                                    Klik "Masuk" di pojok kanan atas, lalu pilih "Daftar sekarang". Isi form dengan data diri Anda dan klik "Daftar".
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#akun2">
                                    Lupa password?
                                </button>
                            </h2>
                            <div id="akun2" class="accordion-collapse collapse" data-bs-parent="#accordionAkun">
                                <div class="accordion-body">
                                    Klik "Lupa Password" di halaman login, masukkan email Anda, dan ikuti instruksi yang dikirim ke email.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#akun3">
                                    Bagaimana cara mengubah data profil?
                                </button>
                            </h2>
                            <div id="akun3" class="accordion-collapse collapse" data-bs-parent="#accordionAkun">
                                <div class="accordion-body">
                                    Login, klik nama Anda di pojok kanan atas, pilih "Profil", lalu edit data yang ingin diubah.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="pesanan">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionPesanan">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pesanan1">
                                    Bagaimana cara melihat status pesanan?
                                </button>
                            </h2>
                            <div id="pesanan1" class="accordion-collapse collapse show" data-bs-parent="#accordionPesanan">
                                <div class="accordion-body">
                                    Login, klik "Pesanan Saya" di menu dropdown nama Anda. Anda bisa melihat semua pesanan dan statusnya.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pesanan2">
                                    Bisa membatalkan pesanan?
                                </button>
                            </h2>
                            <div id="pesanan2" class="accordion-collapse collapse" data-bs-parent="#accordionPesanan">
                                <div class="accordion-body">
                                    Pesanan dapat dibatalkan jika status masih "Menunggu Pembayaran". Setelah dibayar, pesanan tidak dapat dibatalkan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="pembayaran">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Pembayaran</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionPembayaran">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bayar1">
                                    Metode pembayaran apa saja yang tersedia?
                                </button>
                            </h2>
                            <div id="bayar1" class="accordion-collapse collapse show" data-bs-parent="#accordionPembayaran">
                                <div class="accordion-body">
                                    Transfer Bank (BCA, Mandiri, BRI), E-Wallet (OVO, GoPay, DANA), dan COD untuk wilayah tertentu.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bayar2">
                                    Bagaimana cara konfirmasi pembayaran?
                                </button>
                            </h2>
                            <div id="bayar2" class="accordion-collapse collapse" data-bs-parent="#accordionPembayaran">
                                <div class="accordion-body">
                                    Setelah transfer, buka halaman detail pesanan dan klik "Saya Sudah Bayar" atau konfirmasi via WhatsApp.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="pengiriman">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Pengiriman</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionKirim">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#kirim1">
                                    Berapa lama estimasi pengiriman?
                                </button>
                            </h2>
                            <div id="kirim1" class="accordion-collapse collapse show" data-bs-parent="#accordionKirim">
                                <div class="accordion-body">
                                    Reguler: 2-3 hari, Express: 1-2 hari, Same Day: hari yang sama (tergantung wilayah).
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kirim2">
                                    Bagaimana cara melacak pesanan?
                                </button>
                            </h2>
                            <div id="kirim2" class="accordion-collapse collapse" data-bs-parent="#accordionKirim">
                                <div class="accordion-body">
                                    Masukkan nomor resi di halaman "Lacak Pesanan" atau klik link tracking di halaman detail pesanan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4" id="pengembalian">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Pengembalian</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionKembali">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#kembali1">
                                    Barang rusak/cacat, bagaimana?
                                </button>
                            </h2>
                            <div id="kembali1" class="accordion-collapse collapse show" data-bs-parent="#accordionKembali">
                                <div class="accordion-body">
                                    Hubungi customer service maksimal 3 hari setelah barang diterima dengan menyertakan foto.
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