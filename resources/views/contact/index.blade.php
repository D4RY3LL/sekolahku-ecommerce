@extends('layouts.app')

@section('title', 'Kontak Kami - SekolahKu')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Kontak Kami</li>
        </ol>
    </nav>

    <h1 class="mb-4">Kontak Kami</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Kontak</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6>Alamat</h6>
                            <p class="text-muted">Jl. Pendidikan No. 123, Jakarta Pusat, 12345</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <i class="fas fa-phone fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6>Telepon</h6>
                            <p class="text-muted">(021) 1234-5678</p>
                            <p class="text-muted">0812-3456-7890 (WhatsApp)</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6>Email</h6>
                            <p class="text-muted">info@sekolahku.com</p>
                            <p class="text-muted">cs@sekolahku.com (Customer Service)</p>
                        </div>
                    </div>

                    <div class="d-flex mb-4">
                        <div class="me-3">
                            <i class="fas fa-clock fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6>Jam Operasional</h6>
                            <p class="text-muted">Senin - Jumat: 08.00 - 17.00 WIB</p>
                            <p class="text-muted">Sabtu: 08.00 - 14.00 WIB</p>
                            <p class="text-muted">Minggu & Libur Nasional: Tutup</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6>Media Sosial</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-primary btn-sm"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-outline-info btn-sm"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-outline-danger btn-sm"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-outline-success btn-sm"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subjek</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Lokasi Kami</h5>
        </div>
        <div class="card-body p-0">
            <div style="height: 400px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt fa-4x text-primary mb-3"></i>
                    <h5>Jl. Pendidikan No. 123, Jakarta Pusat</h5>
                    <p class="text-muted">(Google Maps akan diintegrasikan di sini)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection