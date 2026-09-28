@extends('layouts.app')

@section('title', 'Tentang Kami - SekolahKu')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Tentang Kami</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <h2>Tentang SekolahKu</h2>
            <p class="lead">Solusi Lengkap Perlengkapan Sekolah Anda</p>
            
            <p>SekolahKu adalah toko online terpercaya yang menyediakan berbagai perlengkapan sekolah berkualitas dengan harga terjangkau. Kami berdiri sejak tahun 2020 dengan misi untuk memudahkan para orang tua dan siswa dalam memenuhi kebutuhan sekolah.</p>
            
            <p>Kami bekerja sama dengan berbagai merek ternama untuk memastikan produk yang kami jual adalah produk berkualitas dan aman digunakan. Dari buku tulis, alat tulis, tas, seragam, hingga perlengkapan lainnya, semua tersedia lengkap di SekolahKu.</p>
            
            <h4 class="mt-4">Visi Kami</h4>
            <p>Menjadi toko perlengkapan sekolah online terbesar dan terpercaya di Indonesia yang memberikan kemudahan dan kenyamanan berbelanja bagi seluruh pelanggan.</p>
            
            <h4 class="mt-4">Misi Kami</h4>
            <ul>
                <li>Menyediakan produk berkualitas dengan harga terjangkau</li>
                <li>Memberikan pelayanan terbaik kepada pelanggan</li>
                <li>Memudahkan akses perlengkapan sekolah di seluruh Indonesia</li>
                <li>Mendukung dunia pendidikan melalui produk-produk berkualitas</li>
            </ul>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Alamat</th>
                            <td>Jl. Pendidikan No. 123, Jakarta</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>0812-3456-7890</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>info@sekolahku.com</td>
                        </tr>
                        <tr>
                            <th>Jam Operasional</th>
                            <td>Senin - Sabtu: 08.00 - 17.00</td>
                        </tr>
                    </table>
                    
                    <div class="mt-3">
                        <h6>Ikuti Kami</h6>
                        <a href="#" class="btn btn-outline-primary me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="btn btn-outline-info me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-danger me-2"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Mengapa Memilih SekolahKu?</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Produk 100% Original</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Harga Terjangkau</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Pengiriman Cepat</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Garansi Uang Kembali</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Layanan Pelanggan 24/7</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection