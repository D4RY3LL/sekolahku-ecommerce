@extends('layouts.app')

@section('title', 'Kebijakan Pengembalian - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kebijakan Pengembalian</li>
        </ol>
    </nav>

    <h1 class="mb-4">Kebijakan Pengembalian Barang</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Syarat Pengembalian</h4>
                    <p>Barang dapat dikembalikan jika memenuhi kriteria berikut:</p>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kondisi</th>
                                    <th>Dapat Dikembalikan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Barang cacat/rusak</td>
                                    <td><span class="badge bg-success">✓ Ya</span></td>
                                    <td>Maksimal 3 hari setelah barang diterima</td>
                                </tr>
                                <tr>
                                    <td>Barang tidak sesuai pesanan</td>
                                    <td><span class="badge bg-success">✓ Ya</span></td>
                                    <td>Maksimal 3 hari setelah barang diterima</td>
                                </tr>
                                <tr>
                                    <td>Barang tidak lengkap</td>
                                    <td><span class="badge bg-success">✓ Ya</span></td>
                                    <td>Maksimal 3 hari setelah barang diterima</td>
                                </tr>
                                <tr>
                                    <td>Berubah pikiran</td>
                                    <td><span class="badge bg-danger">✗ Tidak</span></td>
                                    <td>Kecuali untuk kategori tertentu</td>
                                </tr>
                                <tr>
                                    <td>Kerusakan akibat kesalahan penggunaan</td>
                                    <td><span class="badge bg-danger">✗ Tidak</span></td>
                                    <td>Tidak ditanggung</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h4 class="mt-4">Cara Mengajukan Pengembalian</h4>
                    <ol>
                        <li>Hubungi customer service kami melalui telepon atau email</li>
                        <li>Sertakan nomor pesanan dan foto barang (jika rusak/tidak sesuai)</li>
                        <li>Tim kami akan memproses pengajuan dalam 1x24 jam</li>
                        <li>Jika disetujui, kirim barang ke alamat yang diberikan</li>
                        <li>Dana akan dikembalikan setelah barang kami terima</li>
                    </ol>

                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle"></i> 
                        Biaya pengiriman untuk pengembalian ditanggung oleh pembeli, kecuali jika kesalahan dari pihak SekolahKu.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kontak Pengembalian</h5>
                </div>
                <div class="card-body">
                    <p>Untuk pengajuan pengembalian, hubungi:</p>
                    <p><i class="fas fa-phone me-2"></i> 0812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i> returns@sekolahku.com</p>
                    <p><i class="fas fa-clock me-2"></i> Senin - Jumat: 08.00 - 16.00</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection