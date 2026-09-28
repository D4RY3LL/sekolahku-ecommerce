@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Syarat & Ketentuan</li>
        </ol>
    </nav>

    <h1 class="mb-4">Syarat & Ketentuan</h1>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Terakhir diperbarui: 1 Januari 2024</p>

            <h4>1. Akun Pengguna</h4>
            <p>Dengan membuat akun di SekolahKu, Anda menyetujui:</p>
            <ul>
                <li>Memberikan informasi yang akurat dan lengkap</li>
                <li>Menjaga kerahasiaan password</li>
                <li>Bertanggung jawab atas semua aktivitas akun</li>
                <li>Memberitahu segera jika ada akses tidak sah</li>
            </ul>

            <h4 class="mt-4">2. Pesanan</h4>
            <ul>
                <li>Pesanan akan diproses setelah pembayaran diterima</li>
                <li>Kami berhak membatalkan pesanan jika stok tidak tersedia</li>
                <li>Harga dapat berubah sewaktu-waktu tanpa pemberitahuan</li>
                <li>Diskon tidak dapat digabung kecuali disebutkan</li>
            </ul>

            <h4 class="mt-4">3. Pembayaran</h4>
            <ul>
                <li>Pembayaran harus dilakukan sesuai metode yang dipilih</li>
                <li>Konfirmasi pembayaran maksimal 1x24 jam</li>
                <li>Pesanan akan dibatalkan jika pembayaran tidak diterima</li>
                <li>Biaya transaksi ditanggung pembeli</li>
            </ul>

            <h4 class="mt-4">4. Pengiriman</h4>
            <ul>
                <li>Estimasi pengiriman tergantung kurir dan alamat tujuan</li>
                <li>Keterlambatan di luar kendali kami (cuaca, bencana, dll)</li>
                <li>Alamat yang salah menjadi tanggung jawab pembeli</li>
                <li>Biaya pengiriman non-refundable</li>
            </ul>

            <h4 class="mt-4">5. Pengembalian</h4>
            <ul>
                <li>Pengembalian sesuai dengan kebijakan pengembalian</li>
                <li>Barang harus dalam kondisi original</li>
                <li>Pengembalian dana diproses setelah barang diterima</li>
                <li>Dana dikembalikan sesuai metode pembayaran awal</li>
            </ul>

            <h4 class="mt-4">6. Hak Kekayaan Intelektual</h4>
            <p>Semua konten di website ini (logo, gambar, teks) adalah milik SekolahKu dan dilindungi hak cipta.</p>

            <h4 class="mt-4">7. Pembatasan Tanggung Jawab</h4>
            <p>SekolahKu tidak bertanggung jawab atas:</p>
            <ul>
                <li>Kerugian tidak langsung akibat penggunaan produk</li>
                <li>Keterlambatan pengiriman di luar kendali kami</li>
                <li>Konten website pihak ketiga yang ditautkan</li>
            </ul>

            <h4 class="mt-4">8. Hukum yang Berlaku</h4>
            <p>Syarat dan ketentuan ini tunduk pada hukum Republik Indonesia.</p>
        </div>
    </div>
</div>
@endsection