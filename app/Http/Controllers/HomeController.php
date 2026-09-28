<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();

        // Produk Terlaris: diurutkan berdasarkan jumlah terjual (sold_count) paling banyak
        $bestSellers = Product::where('sold_count', '>', 0)
            ->orderBy('sold_count', 'desc')
            ->limit(8)
            ->get();

        // Jika belum ada produk yang terjual, tampilkan produk terbaru sebagai alternatif
        if ($bestSellers->isEmpty()) {
            $bestSellers = Product::latest()->limit(8)->get();
        }

        // Produk Promo: produk yang memiliki old_price (sedang diskon) dan diurutkan berdasarkan diskon terbesar
        $promoProducts = Product::whereNotNull('old_price')
            ->where('old_price', '>', 'price')
            ->orderByRaw('((old_price - price) / old_price) DESC')
            ->limit(8)
            ->get();

        // Jika tidak ada produk promo, tampilkan produk featured
        if ($promoProducts->isEmpty()) {
            $promoProducts = Product::where('is_featured', true)
                ->limit(8)
                ->get();
        }

        return view('home', compact('categories', 'bestSellers', 'promoProducts'));
    }

    /**
     * Halaman Semua Produk Terlaris
     */
    public function bestSellers()
    {
        $products = Product::where('sold_count', '>', 0)
            ->orderBy('sold_count', 'desc')
            ->paginate(12);

        return view('products.best-sellers', compact('products'));
    }

    /**
     * Halaman Semua Produk Promo
     */
    public function promoProducts()
    {
        $products = Product::whereNotNull('old_price')
            ->where('old_price', '>', 'price')
            ->orderByRaw('((old_price - price) / old_price) DESC')
            ->paginate(12);

        return view('products.promo', compact('products'));
    }

    /**
     * Halaman Daftar Merek
     */
    public function brands()
    {
        // Ambil semua brand unik dari produk
        $brands = Product::select('brand')
            ->distinct()
            ->whereNotNull('brand')
            ->orderBy('brand')
            ->get();

        // Hitung jumlah produk per brand
        foreach ($brands as $brand) {
            $brand->product_count = Product::where('brand', $brand->brand)->count();
        }

        return view('brands.index', compact('brands'));
    }

    /**
     * Halaman Blog
     */
    public function blog()
    {
        // Data blog (bisa dari database atau array)
        $posts = [
            [
                'slug' => 'tips-memilih-perlengkapan-sekolah',
                'title' => 'Tips Memilih Perlengkapan Sekolah yang Tepat',
                'excerpt' => 'Memilih perlengkapan sekolah yang tepat sangat penting untuk menunjang kegiatan belajar anak...',
                'image' => 'blog-1.jpg',
                'date' => '2024-01-15',
                'author' => 'Admin'
            ],
            [
                'slug' => 'cara-merawat-buku-agar-awet',
                'title' => 'Cara Merawat Buku Agar Awet dan Tahan Lama',
                'excerpt' => 'Buku adalah jendela ilmu. Agar ilmu bisa terus diakses, kita perlu merawat buku dengan baik...',
                'image' => 'blog-2.jpg',
                'date' => '2024-01-10',
                'author' => 'Admin'
            ],
            [
                'slug' => 'persiapan-menghadapi-ujian',
                'title' => 'Persiapan Menghadapi Ujian: Perlengkapan yang Dibutuhkan',
                'excerpt' => 'Menjelang ujian, persiapan matang sangat diperlukan. Selain belajar, perlengkapan ujian juga penting...',
                'image' => 'blog-3.jpg',
                'date' => '2024-01-05',
                'author' => 'Admin'
            ],
            [
                'slug' => 'tas-sekolah-ergonomis',
                'title' => 'Pentingnya Memilih Tas Sekolah yang Ergonomis',
                'excerpt' => 'Tas sekolah yang terlalu berat bisa menyebabkan masalah postur tubuh. Pilih tas yang ergonomis...',
                'image' => 'blog-4.jpg',
                'date' => '2023-12-28',
                'author' => 'Admin'
            ],
        ];

        return view('blog.index', compact('posts'));
    }

    /**
     * Halaman Detail Blog
     */
    public function blogDetail($slug)
    {
        // Data blog (contoh)
        $posts = [
            'tips-memilih-perlengkapan-sekolah' => [
                'title' => 'Tips Memilih Perlengkapan Sekolah yang Tepat',
                'content' => '
                    <p>Memilih perlengkapan sekolah yang tepat sangat penting untuk menunjang kegiatan belajar anak. Berikut beberapa tips yang bisa Anda terapkan:</p>
                    
                    <h5>1. Sesuaikan dengan Kebutuhan</h5>
                    <p>Setiap jenjang pendidikan memiliki kebutuhan yang berbeda. Anak SD mungkin membutuhkan lebih banyak buku tulis dan alat mewarnai, sementara anak SMA lebih membutuhkan alat tulis teknis.</p>
                    
                    <h5>2. Perhatikan Kualitas</h5>
                    <p>Pilih produk dengan kualitas baik meskipun harganya sedikit lebih mahal. Produk berkualitas akan lebih awet dan tidak mudah rusak.</p>
                    
                    <h5>3. Pertimbangkan Ergonomi</h5>
                    <p>Tas sekolah harus nyaman dipakai dan tidak membebani punggung. Pilih tas dengan tali lebar dan bantalan yang empuk.</p>
                    
                    <h5>4. Cek Keamanan Produk</h5>
                    <p>Pastikan produk yang dibeli aman untuk anak, tidak mengandung bahan berbahaya, dan memiliki sertifikasi SNI jika diperlukan.</p>
                    
                    <h5>5. Bandingkan Harga</h5>
                    <p>Jangan langsung membeli di tempat pertama. Bandingkan harga di beberapa toko untuk mendapatkan penawaran terbaik.</p>
                ',
                'image' => 'blog-1.jpg',
                'date' => '2024-01-15',
                'author' => 'Admin'
            ],
            'cara-merawat-buku-agar-awet' => [
                'title' => 'Cara Merawat Buku Agar Awet dan Tahan Lama',
                'content' => '
                    <p>Buku adalah jendela ilmu. Agar ilmu bisa terus diakses, kita perlu merawat buku dengan baik. Berikut cara merawat buku agar awet:</p>
                    
                    <h5>1. Gunakan Sampul Buku</h5>
                    <p>Lindungi buku dengan sampul plastik atau kertas. Ini akan mencegah buku kotor dan rusak.</p>
                    
                    <h5>2. Hindari Melipat Halaman</h5>
                    <p>Gunakan pembatas buku daripada melipat halaman. Melipat halaman dapat merusak kertas.</p>
                    
                    <h5>3. Jauhkan dari Air dan Makanan</h5>
                    <p>Hindari membaca sambil makan atau minum. Percikan air atau noda makanan dapat merusak buku.</p>
                    
                    <h5>4. Simpan di Tempat Kering</h5>
                    <p>Hindari tempat lembab yang bisa menyebabkan jamur. Simpan buku di rak yang kering dan terkena sirkulasi udara.</p>
                    
                    <h5>5. Bersihkan Secara Rutin</h5>
                    <p>Bersihkan debu dari buku secara rutin menggunakan kain lembut atau kuas.</p>
                ',
                'image' => 'blog-2.jpg',
                'date' => '2024-01-10',
                'author' => 'Admin'
            ],
            'persiapan-menghadapi-ujian' => [
                'title' => 'Persiapan Menghadapi Ujian: Perlengkapan yang Dibutuhkan',
                'content' => '
                    <p>Menjelang ujian, persiapan matang sangat diperlukan. Selain belajar, perlengkapan ujian juga penting. Berikut daftar perlengkapan yang perlu disiapkan:</p>
                    
                    <h5>1. Alat Tulis</h5>
                    <p>Siapkan pensil 2B, pulpen, penghapus, dan rautan. Pastikan semua dalam kondisi baik.</p>
                    
                    <h5>2. Kartu Ujian</h5>
                    <p>Jangan lupa membawa kartu peserta ujian dan identitas diri.</p>
                    
                    <h5>3. Jam Tangan</h5>
                    <p>Bawa jam tangan untuk mengatur waktu mengerjakan soal. HP biasanya tidak diperbolehkan masuk ruang ujian.</p>
                    
                    <h5>4. Air Minum</h5>
                    <p>Bawa air minum dalam botol transparan untuk menjaga konsentrasi.</p>
                    
                    <h5>5. Obat Pribadi</h5>
                    <p>Jika memiliki kondisi kesehatan tertentu, siapkan obat pribadi.</p>
                ',
                'image' => 'blog-3.jpg',
                'date' => '2024-01-05',
                'author' => 'Admin'
            ],
        ];

        if (!isset($posts[$slug])) {
            abort(404);
        }

        $post = $posts[$slug];

        return view('blog.show', compact('post'));
    }

    /**
     * Halaman Tentang Kami
     */
    public function about()
    {
        return view('about.index');
    }

    /**
     * Halaman Kontak
     */
    public function contact()
    {
        return view('contact.index');
    }

    /**
     * Kirim pesan kontak
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Kirim email atau simpan ke database
        // Untuk sementara, hanya tampilkan pesan sukses

        return redirect()->route('contact')->with('success', 'Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');
    }

    /**
     * Halaman Cara Belanja
     */
    public function caraBelanja()
    {
        return view('pages.cara-belanja');
    }

    /**
     * Halaman Pembayaran
     */
    public function pembayaran()
    {
        return view('pages.pembayaran');
    }

    /**
     * Halaman Pengiriman
     */
    public function pengiriman()
    {
        return view('pages.pengiriman');
    }

    /**
     * Halaman Pengembalian
     */
    public function pengembalian()
    {
        return view('pages.pengembalian');
    }

    /**
     * Halaman Kebijakan Privasi
     */
    public function kebijakanPrivasi()
    {
        return view('pages.kebijakan-privasi');
    }

    /**
     * Halaman Syarat & Ketentuan
     */
    public function syaratKetentuan()
    {
        return view('pages.syarat-ketentuan');
    }

    /**
     * Halaman FAQ
     */
    public function faq()
    {
        return view('pages.faq');
    }

    /**
     * Halaman Bantuan
     */
    public function bantuan()
    {
        return view('pages.bantuan');
    }

    /**
     * Halaman Lacak Pesanan
     */
    public function lacakPesanan()
    {
        return view('pages.lacak-pesanan');
    }

    /**
     * Cari Pesanan berdasarkan nomor pesanan
     */
    public function cariPesanan(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string'
        ]);

        $order = Order::where('order_number', $request->order_number)->first();

        if (!$order) {
            return back()->with('error', 'Nomor pesanan tidak ditemukan');
        }

        return redirect()->route('orders.track', $order->order_number);
    }

    /**
     * Tracking pesanan publik
     */
    public function trackOrder($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['items.product', 'user'])
            ->firstOrFail();

        return view('pages.track-order', compact('order'));
    }

    
}
