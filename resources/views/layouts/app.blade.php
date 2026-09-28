<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SekolahKu') - Toko Perlengkapan Sekolah Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
    <style>
        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .pagination .page-item {
            list-style: none;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 10px;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            color: #667eea;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination .page-link:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .pagination .page-item.active .page-link {
            background: #667eea;
            color: white;
            border-color: #667eea;
            font-weight: bold;
        }

        .pagination .page-item.disabled .page-link {
            background: #f8f9fa;
            color: #b2bec3;
            border-color: #e0e0e0;
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            padding: 0 15px;
            font-weight: 600;
        }

        /* Info Bar */
        .info-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f9fa;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid #e0e0e0;
        }

        .info-bar h4 {
            margin: 0;
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .info-bar span {
            color: #667eea;
            font-weight: 500;
            background: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Top Header */
        .top-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }

        .top-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-header a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        /* Main Header */
        .main-header {
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .main-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
            margin: 0 30px;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-bar button {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .header-icons {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .icon-btn {
            position: relative;
            cursor: pointer;
            font-size: 24px;
            color: #333;
            transition: color 0.3s;
            text-decoration: none;
        }

        .icon-btn:hover {
            color: #667eea;
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .login-btn {
            background: #667eea;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: #5568d3;
            color: white;
        }

        /* Navigation */
        .nav-menu {
            background: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }

        .nav-menu .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            gap: 30px;
        }

        .nav-menu a {
            padding: 15px 0;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            position: relative;
            transition: color 0.3s;
        }

        .nav-menu a:hover {
            color: #667eea;
        }

        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #667eea;
        }

        /* Footer */
        .footer {
            background: #2d3436;
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer h4 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer ul {
            list-style: none;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer a {
            color: #b2bec3;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: white;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 20px 0;
            border-top: 1px solid #636e72;
            text-align: center;
            color: #b2bec3;
        }

        /* Alert Messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-bar {
                margin: 15px 0;
            }

            .nav-menu .container {
                overflow-x: auto;
                white-space: nowrap;
            }

            .header-icons {
                gap: 15px;
            }

            .login-btn {
                padding: 8px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div>📞 Hubungi Kami: 0812-3456-7890 | ✉️ info@sekolahku.com</div>
            <div>
                <a href="{{ route('bantuan') }}">Bantuan</a>
                <a href="{{ route('lacak-pesanan') }}">Lacak Pesanan</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <a href="{{ route('home') }}" class="logo">
                🎒 SekolahKu
            </a>

            <form action="{{ route('products.index') }}" method="GET" class="search-bar">
                <input type="text" name="search" placeholder="Cari perlengkapan sekolah..." value="{{ request('search') }}">
                <button type="submit">Cari</button>
            </form>

            <div class="header-icons">
                <a href="{{ route('wishlist.index') }}" class="icon-btn">
                    ❤️
                    @auth
                    @php
                    $wishlistCount = App\Http\Controllers\WishlistController::count();
                    @endphp
                    @if($wishlistCount > 0)
                    <span class="badge">{{ $wishlistCount }}</span>
                    @endif
                    @endauth
                </a>

                <a href="{{ route('cart.index') }}" class="icon-btn">
                    🛒
                    @auth
                    @php
                    $cartCount = App\Http\Controllers\CartController::count();
                    @endphp
                    @if($cartCount > 0)
                    <span class="badge">{{ $cartCount }}</span>
                    @endif
                    @endauth
                </a>

                @auth
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('orders.index') }}">Pesanan Saya</a></li>
                        <li><a class="dropdown-item" href="{{ route('wishlist.index') }}">Wishlist</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a></li>
                        @if(auth()->user()->role === 'admin')
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <a href="{{ route('login') }}" class="login-btn">Masuk</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Navigation Menu -->
    <nav class="nav-menu">
        <div class="container">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.index') ? 'active' : '' }}">Semua Produk</a>
            <a href="{{ route('products.best-sellers') }}" class="{{ request()->routeIs('products.best-sellers') ? 'active' : '' }}">Terlaris</a>
            <a href="{{ route('products.promo') }}" class="{{ request()->routeIs('products.promo') ? 'active' : '' }}">Promo</a>
            <a href="{{ route('brands.index') }}" class="{{ request()->routeIs('brands.index') ? 'active' : '' }}">Merek</a>
            <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
        </div>
    </nav>

    <!-- Alert Messages -->
    <div class="container mt-3">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h4>Tentang SekolahKu</h4>
                <p>SekolahKu adalah toko online terpercaya yang menyediakan berbagai perlengkapan sekolah berkualitas dengan harga terjangkau.</p>
            </div>
            <div>
                <h4>Layanan</h4>
                <ul>
                    <li><a href="{{ route('cara-belanja') }}">Cara Belanja</a></li>
                    <li><a href="{{ route('pembayaran') }}">Pembayaran</a></li>
                    <li><a href="{{ route('pengiriman') }}">Pengiriman</a></li>
                    <li><a href="{{ route('pengembalian') }}">Pengembalian</a></li>
                </ul>
            </div>
            <div>
                <h4>Informasi</h4>
                <ul>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}">Kontak Kami</a></li>
                    <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('syarat-ketentuan') }}">Syarat & Ketentuan</a></li>
                    <li><a href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h4>Hubungi Kami</h4>
                <ul>
                    <li>📍 Jl. Pendidikan No. 123, Jakarta</li>
                    <li>📞 0812-3456-7890</li>
                    <li>✉️ info@sekolahku.com</li>
                    <li>🕒 Senin - Sabtu: 08.00 - 17.00</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 SekolahKu. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Auto hide alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>