<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SekolahKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        .logo {
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-login {
            background: #667eea;
            color: white;
            padding: 12px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #5568d3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo">🎒 SekolahKu</div>
        <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" required>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Ingat Saya</label>
            </div>

            <button type="submit" class="btn btn-login w-100 mb-3">Masuk</button>

            <p class="text-center mb-0">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </p>

            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">
                    <i class="fas fa-key me-1"></i>Lupa Password?
                </a>
            </div>
        </form>
    </div>
</body>

</html>