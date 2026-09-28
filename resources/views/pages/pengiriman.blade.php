@extends('layouts.app')

@section('title', 'Informasi Pengiriman - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Informasi Pengiriman</li>
        </ol>
    </nav>

    <h1 class="mb-4">Informasi Pengiriman</h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Kurir Pengiriman</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kurir</th>
                                <th>Layanan</th>
                                <th>Estimasi</th>
                                <th>Tarif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="2">JNE</td>
                                <td>Reguler</td>
                                <td>2-3 hari</td>
                                <td>Rp 15.000 - Rp 25.000</td>
                            </tr>
                            <tr>
                                <td>Express</td>
                                <td>1-2 hari</td>
                                <td>Rp 25.000 - Rp 40.000</td>
                            </tr>
                            <tr>
                                <td rowspan="2">TIKI</td>
                                <td>Reguler</td>
                                <td>2-3 hari</td>
                                <td>Rp 14.000 - Rp 23.000</td>
                            </tr>
                            <tr>
                                <td>Express</td>
                                <td>1-2 hari</td>
                                <td>Rp 23.000 - Rp 38.000</td>
                            </tr>
                            <tr>
                                <td rowspan="2">SiCepat</td>
                                <td>Reguler</td>
                                <td>2-3 hari</td>
                                <td>Rp 16.000 - Rp 27.000</td>
                            </tr>
                            <tr>
                                <td>Same Day</td>
                                <td>Hari yang sama</td>
                                <td>Rp 35.000 - Rp 50.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Gratis Ongkir</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <i class="fas fa-truck"></i> <strong>GRATIS ONGKIR</strong> untuk pembelian minimal Rp 100.000!
                    </div>
                    <p>Syarat dan Ketentuan:</p>
                    <ul>
                        <li>Minimal belanja Rp 100.000 dalam satu transaksi</li>
                        <li>Berlaku untuk semua kurir (kecuali Same Day)</li>
                        <li>Maksimal potongan ongkir Rp 20.000</li>
                        <li>Tidak dapat digabung dengan promo lainnya</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Lacak Pesanan</h5>
                </div>
                <div class="card-body">
                    <p>Masukkan nomor resi untuk melacak pesanan:</p>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Contoh: JNE123456789">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lacak</button>
                    </form>
                    <hr>
                    <p class="text-muted small">Nomor resi akan dikirim via email setelah pesanan dikirim</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection