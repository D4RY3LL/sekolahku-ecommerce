@extends('layouts.app')

@section('title', 'Verifikasi Email - SekolahKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Verifikasi Email</h4>
                </div>
                <div class="card-body text-center">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <i class="fas fa-envelope fa-4x text-primary mb-3"></i>
                    <h5>Verifikasi Alamat Email Anda</h5>
                    <p class="text-muted">Kami telah mengirimkan link verifikasi ke email Anda.</p>
                    <p class="text-muted">Silakan cek email Anda dan klik link verifikasi.</p>

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-decoration-none">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection