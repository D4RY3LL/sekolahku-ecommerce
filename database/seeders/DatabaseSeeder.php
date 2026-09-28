<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\ProductImageHelper;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // USERS
        // =========================
        if (!User::where('email', 'admin@sekolahku.com')->exists()) {
            User::create([
                'name' => 'Admin SekolahKu',
                'email' => 'admin@sekolahku.com',
                'password' => Hash::make('admin123'),
                'phone' => '081234567890',
                'address' => 'Jl. Admin No. 1, Jakarta',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        if (!User::where('email', 'user@example.com')->exists()) {
            User::create([
                'name' => 'User Biasa',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'phone' => '081298765432',
                'address' => 'Jl. User No. 1, Jakarta',
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }

        // =========================
        // CATEGORIES
        // =========================
        $categories = [
            ['name' => 'Buku Tulis', 'icon' => '📓', 'description' => 'Buku tulis berbagai ukuran dan merek'],
            ['name' => 'Alat Tulis', 'icon' => '✏️', 'description' => 'Pulpen, pensil, penghapus, dll'],
            ['name' => 'Alat Gambar', 'icon' => '🎨', 'description' => 'Peralatan menggambar dan mewarnai'],
            ['name' => 'Tas Sekolah', 'icon' => '🎒', 'description' => 'Tas ransel, tas selempang, dll'],
            ['name' => 'Seragam', 'icon' => '👕', 'description' => 'Seragam sekolah dan perlengkapannya'],
            ['name' => 'Perlengkapan', 'icon' => '💼', 'description' => 'Perlengkapan sekolah lainnya'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['name' => $cat['name']],
                [
                    'slug' => Str::slug($cat['name']),
                    'icon' => $cat['icon'],
                    'description' => $cat['description'],
                ]
            );
        }

        // Ambil semua category id biar rapi
        $categoryMap = Category::pluck('id', 'name');

        // =========================
        // PRODUCTS (30 DATA)
        // =========================
        $products = [
            // ==================== BUKU TULIS (5) ====================
            [
                'category_name' => 'Buku Tulis',
                'name' => 'Buku Tulis Campus B5 50 Lembar',
                'description' => 'Buku tulis berkualitas dengan kertas tebal dan cover menarik, cocok untuk catatan sekolah harian.',
                'price' => 8000,
                'old_price' => 10000,
                'stock' => 100,
                'weight' => 200,
                'brand' => 'Campus',
                'rating' => 4.8,
                'sold_count' => 150,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Buku Tulis',
                'name' => 'Buku Tulis SIDU A5 38 Lembar',
                'description' => 'Buku tulis ukuran A5 dengan kertas halus dan nyaman digunakan untuk menulis pelajaran.',
                'price' => 6500,
                'old_price' => 8000,
                'stock' => 120,
                'weight' => 150,
                'brand' => 'SIDU',
                'rating' => 4.7,
                'sold_count' => 200,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Buku Tulis',
                'name' => 'Buku Tulis Kiky 40 Lembar',
                'description' => 'Buku tulis dengan desain cover menarik dan kertas berkualitas untuk kegiatan belajar.',
                'price' => 5500,
                'old_price' => 7000,
                'stock' => 150,
                'weight' => 150,
                'brand' => 'Kiky',
                'rating' => 4.6,
                'sold_count' => 120,
                'is_featured' => false,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Buku Tulis',
                'name' => 'Buku Catatan Spiral A5',
                'description' => 'Buku catatan spiral praktis yang mudah dibawa dan cocok untuk mencatat tugas sekolah.',
                'price' => 12000,
                'old_price' => 15000,
                'stock' => 90,
                'weight' => 180,
                'brand' => 'Joyko',
                'rating' => 4.7,
                'sold_count' => 95,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Buku Tulis',
                'name' => 'Buku Gambar A4 20 Lembar',
                'description' => 'Buku gambar ukuran A4 dengan kertas tebal, cocok untuk tugas seni dan menggambar.',
                'price' => 14000,
                'old_price' => 17000,
                'stock' => 80,
                'weight' => 220,
                'brand' => 'Kiky',
                'rating' => 4.5,
                'sold_count' => 70,
                'is_featured' => false,
                'is_best_seller' => false,
            ],

            // ==================== ALAT TULIS (8) ====================
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Pensil 2B Faber Castell (12 pcs)',
                'description' => 'Pensil 2B premium untuk menulis, menggambar, dan keperluan ujian sekolah.',
                'price' => 24000,
                'old_price' => 28000,
                'stock' => 60,
                'weight' => 150,
                'brand' => 'Faber Castell',
                'rating' => 4.9,
                'sold_count' => 200,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Pulpen Gel Hitam Standard AE7',
                'description' => 'Pulpen gel dengan tinta hitam pekat, nyaman dipakai untuk menulis dalam waktu lama.',
                'price' => 15000,
                'old_price' => null,
                'stock' => 75,
                'weight' => 50,
                'brand' => 'Standard',
                'rating' => 4.8,
                'sold_count' => 180,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Penghapus Putih Staedtler',
                'description' => 'Penghapus berkualitas tinggi yang tidak merusak kertas dan mudah digunakan.',
                'price' => 5000,
                'old_price' => null,
                'stock' => 200,
                'weight' => 20,
                'brand' => 'Staedtler',
                'rating' => 4.9,
                'sold_count' => 300,
                'is_featured' => false,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Pensil Mekanik 0.5 Joyko',
                'description' => 'Pensil mekanik dengan lead 0.5 mm, praktis tanpa perlu diraut.',
                'price' => 12000,
                'old_price' => 15000,
                'stock' => 60,
                'weight' => 30,
                'brand' => 'Joyko',
                'rating' => 4.7,
                'sold_count' => 90,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Stabilo Highlighter 6 Warna',
                'description' => 'Set highlighter 6 warna cerah untuk menandai catatan penting di buku pelajaran.',
                'price' => 55000,
                'old_price' => 65000,
                'stock' => 30,
                'weight' => 120,
                'brand' => 'Stabilo',
                'rating' => 4.9,
                'sold_count' => 85,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Penggaris Transparan 30cm',
                'description' => 'Penggaris plastik transparan 30 cm, cocok untuk keperluan sekolah.',
                'price' => 8000,
                'old_price' => 10000,
                'stock' => 100,
                'weight' => 40,
                'brand' => 'Joyko',
                'rating' => 4.5,
                'sold_count' => 110,
                'is_featured' => false,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Gunting Kertas Kenko',
                'description' => 'Gunting sekolah yang tajam, aman, dan nyaman digunakan untuk prakarya.',
                'price' => 15000,
                'old_price' => 18000,
                'stock' => 55,
                'weight' => 70,
                'brand' => 'Kenko',
                'rating' => 4.6,
                'sold_count' => 75,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Tulis',
                'name' => 'Lem Stick UHU 21gr',
                'description' => 'Lem stick praktis dan bersih untuk keperluan kerajinan dan tugas sekolah.',
                'price' => 13000,
                'old_price' => 15000,
                'stock' => 70,
                'weight' => 35,
                'brand' => 'UHU',
                'rating' => 4.7,
                'sold_count' => 88,
                'is_featured' => false,
                'is_best_seller' => false,
            ],

            // ==================== ALAT GAMBAR (5) ====================
            [
                'category_name' => 'Alat Gambar',
                'name' => 'Pensil Warna Faber Castell 24 Warna',
                'description' => 'Pensil warna 24 warna dengan hasil cerah dan halus, cocok untuk tugas seni.',
                'price' => 38000,
                'old_price' => 45000,
                'stock' => 40,
                'weight' => 250,
                'brand' => 'Faber Castell',
                'rating' => 4.8,
                'sold_count' => 90,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Gambar',
                'name' => 'Crayon 24 Warna Joyko',
                'description' => 'Crayon 24 warna dengan warna cerah dan mudah digunakan anak-anak.',
                'price' => 32000,
                'old_price' => 39000,
                'stock' => 45,
                'weight' => 280,
                'brand' => 'Joyko',
                'rating' => 4.7,
                'sold_count' => 78,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Gambar',
                'name' => 'Cat Air Sakura 12 Warna',
                'description' => 'Cat air berkualitas dengan warna cerah, cocok untuk tugas menggambar dan melukis.',
                'price' => 42000,
                'old_price' => 50000,
                'stock' => 25,
                'weight' => 220,
                'brand' => 'Sakura',
                'rating' => 4.7,
                'sold_count' => 50,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Gambar',
                'name' => 'Kuas Lukis Set 6 pcs',
                'description' => 'Set kuas lukis dengan berbagai ukuran untuk berbagai teknik mewarnai.',
                'price' => 35000,
                'old_price' => 45000,
                'stock' => 25,
                'weight' => 100,
                'brand' => 'Artist',
                'rating' => 4.6,
                'sold_count' => 35,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Alat Gambar',
                'name' => 'Palet Cat Plastik',
                'description' => 'Palet cat plastik ringan dan praktis untuk mencampur warna saat melukis.',
                'price' => 10000,
                'old_price' => 12000,
                'stock' => 50,
                'weight' => 60,
                'brand' => 'Artline',
                'rating' => 4.5,
                'sold_count' => 42,
                'is_featured' => false,
                'is_best_seller' => false,
            ],

            // ==================== TAS SEKOLAH (4) ====================
            [
                'category_name' => 'Tas Sekolah',
                'name' => 'Tas Ransel Sekolah Anti Air',
                'description' => 'Tas sekolah berbahan anti air dengan banyak kompartemen, nyaman untuk membawa buku.',
                'price' => 125000,
                'old_price' => 150000,
                'stock' => 30,
                'weight' => 800,
                'brand' => 'Eiger',
                'rating' => 4.6,
                'sold_count' => 60,
                'is_featured' => true,
                'is_best_seller' => true,
            ],
            [
                'category_name' => 'Tas Sekolah',
                'name' => 'Tas Selempang Sekolah Casual',
                'description' => 'Tas selempang ringan dan praktis untuk membawa perlengkapan sekolah harian.',
                'price' => 69000,
                'old_price' => 85000,
                'stock' => 20,
                'weight' => 400,
                'brand' => 'Eiger',
                'rating' => 4.5,
                'sold_count' => 28,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Tas Sekolah',
                'name' => 'Tas Laptop Pelajar 14 Inch',
                'description' => 'Tas laptop pelajar dengan ruang penyimpanan luas dan desain modern.',
                'price' => 145000,
                'old_price' => 175000,
                'stock' => 18,
                'weight' => 900,
                'brand' => 'Arei',
                'rating' => 4.7,
                'sold_count' => 22,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Tas Sekolah',
                'name' => 'Tas Anak Karakter Lucu',
                'description' => 'Tas anak dengan desain karakter lucu, cocok untuk siswa sekolah dasar.',
                'price' => 89000,
                'old_price' => 110000,
                'stock' => 25,
                'weight' => 500,
                'brand' => 'Unbranded',
                'rating' => 4.6,
                'sold_count' => 48,
                'is_featured' => false,
                'is_best_seller' => false,
            ],

            // ==================== SERAGAM (3) ====================
            [
                'category_name' => 'Seragam',
                'name' => 'Seragam SD Putih Merah',
                'description' => 'Seragam SD bahan adem dan nyaman dipakai untuk kegiatan belajar di sekolah.',
                'price' => 120000,
                'old_price' => 150000,
                'stock' => 50,
                'weight' => 400,
                'brand' => 'Seragamku',
                'rating' => 4.5,
                'sold_count' => 60,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Seragam',
                'name' => 'Seragam Pramuka SD',
                'description' => 'Seragam pramuka lengkap untuk siswa SD dengan bahan nyaman dan jahitan rapi.',
                'price' => 95000,
                'old_price' => 120000,
                'stock' => 35,
                'weight' => 380,
                'brand' => 'Pramuka',
                'rating' => 4.5,
                'sold_count' => 40,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Seragam',
                'name' => 'Dasi Sekolah Merah',
                'description' => 'Dasi sekolah merah dengan bahan berkualitas dan nyaman digunakan.',
                'price' => 15000,
                'old_price' => 20000,
                'stock' => 70,
                'weight' => 50,
                'brand' => 'Seragamku',
                'rating' => 4.4,
                'sold_count' => 55,
                'is_featured' => false,
                'is_best_seller' => false,
            ],

            // ==================== PERLENGKAPAN (5) ====================
            [
                'category_name' => 'Perlengkapan',
                'name' => 'Tempat Pensil Kain',
                'description' => 'Tempat pensil berbahan kain dengan desain simpel dan kapasitas cukup besar.',
                'price' => 15000,
                'old_price' => 20000,
                'stock' => 60,
                'weight' => 50,
                'brand' => 'Stationery',
                'rating' => 4.5,
                'sold_count' => 80,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Perlengkapan',
                'name' => 'Botol Minum Sekolah 500ml',
                'description' => 'Botol minum 500ml dengan desain simpel, aman digunakan dan mudah dibawa.',
                'price' => 25000,
                'old_price' => 30000,
                'stock' => 50,
                'weight' => 120,
                'brand' => 'Tupperware',
                'rating' => 4.6,
                'sold_count' => 70,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Perlengkapan',
                'name' => 'Kalkulator Saintifik Casio',
                'description' => 'Kalkulator saintifik untuk pelajaran matematika, fisika, dan kimia.',
                'price' => 85000,
                'old_price' => 99000,
                'stock' => 25,
                'weight' => 180,
                'brand' => 'Casio',
                'rating' => 4.8,
                'sold_count' => 40,
                'is_featured' => true,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Perlengkapan',
                'name' => 'Jam Tangan Anak Digital',
                'description' => 'Jam tangan anak dengan desain digital modern dan tahan percikan air.',
                'price' => 75000,
                'old_price' => 95000,
                'stock' => 20,
                'weight' => 50,
                'brand' => 'Casio',
                'rating' => 4.7,
                'sold_count' => 35,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
            [
                'category_name' => 'Perlengkapan',
                'name' => 'Tempat Bekal Makan Anak',
                'description' => 'Kotak bekal praktis anti tumpah dan aman digunakan untuk makanan sekolah.',
                'price' => 35000,
                'old_price' => 45000,
                'stock' => 35,
                'weight' => 200,
                'brand' => 'LocknLock',
                'rating' => 4.7,
                'sold_count' => 50,
                'is_featured' => false,
                'is_best_seller' => false,
            ],
        ];

        // =========================
        // INSERT PRODUCTS
        // =========================
        foreach ($products as $productData) {
            $categoryName = $productData['category_name'];
            $productName = $productData['name'];

            Product::updateOrCreate(
                ['slug' => Str::slug($productName)],
                [
                    'category_id' => $categoryMap[$categoryName] ?? null,
                    'name' => $productName,
                    'slug' => Str::slug($productName),
                    'description' => $productData['description'],
                    'price' => $productData['price'],
                    'old_price' => $productData['old_price'],
                    'stock' => $productData['stock'],
                    'weight' => $productData['weight'],
                    'brand' => $productData['brand'],
                    'image' => ProductImageHelper::getImageUrl($productName, $categoryName),
                    'rating' => $productData['rating'],
                    'sold_count' => $productData['sold_count'],
                    'is_featured' => $productData['is_featured'],
                    'is_best_seller' => $productData['is_best_seller'],
                ]
            );

            $this->command->info('Product seeded: ' . $productName);
        }

        $this->command->info('✅ Database seeding completed! 30 products created successfully.');
    }
}