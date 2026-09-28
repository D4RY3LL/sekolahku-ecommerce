@extends('layouts.app')

@section('title', 'Metode Pembayaran - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Metode Pembayaran</li>
        </ol>
    </nav>

    <h1 class="mb-4">Metode Pembayaran</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Transfer Bank</h5>
                </div>
                <div class="card-body">
                    <p>Pembayaran dapat dilakukan melalui transfer ke rekening bank berikut:</p>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th>Bank BCA</th>
                            <td>
                                <strong>No. Rekening:</strong> 1234567890<br>
                                <strong>Atas Nama:</strong> PT SekolahKu
                            </td>
                        </tr>
                        <tr>
                            <th>Bank Mandiri</th>
                            <td>
                                <strong>No. Rekening:</strong> 0987654321<br>
                                <strong>Atas Nama:</strong> PT SekolahKu
                            </td>
                        </tr>
                        <tr>
                            <th>Bank BRI</th>
                            <td>
                                <strong>No. Rekening:</strong> 5678901234<br>
                                <strong>Atas Nama:</strong> PT SekolahKu
                            </td>
                        </tr>
                    </table>
                    
                    <div class="alert alert-warning mt-3">
                        <i class="fas fa-info-circle"></i> 
                        Setelah transfer, silakan konfirmasi pembayaran di halaman detail pesanan.
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">E-Wallet</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="p-3 border rounded">
                                <i class="fab fa-cc-visa fa-3x text-primary"></i>
                                <h6 class="mt-2">OVO</h6>
                                <p class="text-muted">0812-3456-7890</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="p-3 border rounded">
                                <i class="fab fa-cc-visa fa-3x text-success"></i>
                                <h6 class="mt-2">GoPay</h6>
                                <p class="text-muted">0812-3456-7890</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="p-3 border rounded">
                                <i class="fab fa-cc-visa fa-3x text-info"></i>
                                <h6 class="mt-2">DANA</h6>
                                <p class="text-muted">0812-3456-7890</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Cash On Delivery (COD)</h5>
                </div>
                <div class="card-body">
                    <p>Bayar langsung saat pesanan diterima. Tersedia untuk wilayah tertentu.</p>
                    <p><strong>Biaya COD:</strong> Rp 5.000 - Rp 10.000 (tergantung wilayah)</p>
                    <p><strong>Syarat:</strong> Maksimal pembelian Rp 500.000</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Penting</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Pembayaran harus sesuai total belanja</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Konfirmasi pembayaran maksimal 1x24 jam</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Pesanan akan diproses setelah pembayaran diterima</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Untuk COD, siapkan uang pas</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection