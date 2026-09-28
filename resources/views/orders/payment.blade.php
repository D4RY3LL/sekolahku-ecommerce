@extends('layouts.app')

@section('title', 'Pembayaran - SekolahKu')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($order->payment_status == 'paid' || $order->status != 'pending')
                <div class="alert alert-warning text-center">
                    <h4>Pesanan ini sudah tidak memerlukan pembayaran</h4>
                    <p>Status pesanan: <strong>{{ $order->status_label }}</strong></p>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Lihat Detail Pesanan</a>
                </div>
            @else
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Instruksi Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                            <h3 class="mt-3">Pesanan Berhasil Dibuat!</h3>
                            <p class="text-muted">Nomor Pesanan: <strong>{{ $order->order_number }}</strong></p>
                        </div>

                        <div class="alert alert-info">
                            <h6>Total Pembayaran:</h6>
                            <h4 class="text-primary">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</h4>
                        </div>

                        <h5 class="mt-4">Instruksi Pembayaran Transfer Bank:</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Bank BCA</h6>
                                        <p class="mb-1">No. Rekening: 1234567890</p>
                                        <p class="mb-1">Atas Nama: PT SekolahKu</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Bank Mandiri</h6>
                                        <p class="mb-1">No. Rekening: 0987654321</p>
                                        <p class="mb-1">Atas Nama: PT SekolahKu</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-info-circle"></i> 
                            Harap transfer sesuai dengan total pembayaran. Konfirmasi pembayaran akan diproses setelah dana masuk.
                        </div>

                        <form action="{{ route('orders.confirm-payment', $order->id) }}" method="POST" class="mt-4">
                            @csrf
                            <div class="alert alert-success">
                                <p><strong>Setelah melakukan transfer, klik tombol di bawah untuk konfirmasi:</strong></p>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Konfirmasi bahwa Anda sudah melakukan pembayaran?')">
                                    <i class="fas fa-check"></i> Saya Sudah Bayar
                                </button>
                            </div>
                        </form>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                Lihat Detail Pesanan
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection