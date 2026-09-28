@extends('layouts.app')

@section('title', 'Kebijakan Privasi - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kebijakan Privasi</li>
        </ol>
    </nav>

    <h1 class="mb-4">Kebijakan Privasi</h1>

    <div class="card">
        <div class="card-body">
            <p class="text-muted">Terakhir diperbarui: 1 Januari 2024</p>

            <h4>1. Informasi yang Kami Kumpulkan</h4>
            <p>Kami mengumpulkan informasi berikut saat Anda menggunakan layanan SekolahKu:</p>
            <ul>
                <li>Informasi pribadi (nama, email, nomor telepon, alamat)</li>
                <li>Informasi transaksi (riwayat pembelian, metode pembayaran)</li>
                <li>Informasi penggunaan website</li>
            </ul>

            <h4 class="mt-4">2. Penggunaan Informasi</h4>
            <p>Informasi yang kami kumpulkan digunakan untuk:</p>
            <ul>
                <li>Memproses pesanan dan pembayaran Anda</li>
                <li>Mengirim konfirmasi pesanan dan informasi pengiriman</li>
                <li>Meningkatkan layanan dan pengalaman berbelanja</li>
                <li>Mengirim promo dan penawaran khusus (dengan persetujuan)</li>
            </ul>

            <h4 class="mt-4">3. Keamanan Data</h4>
            <p>Kami menjaga keamanan data Anda dengan:</p>
            <ul>
                <li>Enkripsi data sensitif</li>
                <li>Server yang aman dan terproteksi</li>
                <li>Akses terbatas ke data pribadi</li>
                <li>Audit keamanan secara berkala</li>
            </ul>

            <h4 class="mt-4">4. Pengungkapan Data</h4>
            <p>Kami tidak menjual atau menyewakan data pribadi Anda. Data hanya dibagikan dengan:</p>
            <ul>
                <li>Pihak pengiriman (untuk pengiriman pesanan)</li>
                <li>Pihak pembayaran (untuk proses transaksi)</li>
                <li>Instansi pemerintah (jika diwajibkan hukum)</li>
            </ul>

            <h4 class="mt-4">5. Hak Anda</h4>
            <p>Anda memiliki hak untuk:</p>
            <ul>
                <li>Mengakses data pribadi Anda</li>
                <li>Memperbaiki data yang tidak akurat</li>
                <li>Menghapus akun dan data Anda</li>
                <li>Menolak menerima promo</li>
            </ul>

            <h4 class="mt-4">6. Cookie</h4>
            <p>Website kami menggunakan cookie untuk meningkatkan pengalaman browsing. Anda dapat mengatur preferensi cookie melalui browser Anda.</p>

            <h4 class="mt-4">7. Perubahan Kebijakan</h4>
            <p>Kebijakan privasi dapat diperbarui sewaktu-waktu. Perubahan akan diinformasikan melalui website atau email.</p>

            <h4 class="mt-4">8. Kontak</h4>
            <p>Jika ada pertanyaan tentang kebijakan privasi, hubungi:</p>
            <p><i class="fas fa-envelope me-2"></i> privacy@sekolahku.com</p>
            <p><i class="fas fa-phone me-2"></i> 0812-3456-7890</p>
        </div>
    </div>
</div>
@endsection