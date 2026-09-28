@extends('layouts.admin')

@section('title', 'Manajemen Produk - Admin SekolahKu')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Manajemen Produk</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Terjual</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $product)
                        <tr>
                            <td>{{ $products->firstItem() + $index }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span style="font-size: 30px;">📦</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->sold_count }}</td>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge bg-success">Featured</span>
                                @endif
                                @if($product->is_best_seller)
                                    <span class="badge bg-warning">Best Seller</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="text-center text-gray-500 mt-6">
                Showing {{ $products->firstItem() }} - {{ $products->lastItem() }}
                of {{ $products->total() }} products
            </p>

            <!-- Pagination -->
            @if ($products->lastPage() > 1)

            <nav class="mt-4">
                <ul class="pagination justify-content-center">

                    {{-- Previous --}}
                    @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">‹</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}">‹</a>
                    </li>
                    @endif

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $products->lastPage(); $i++)

                        @if ($i == $products->currentPage())

                        <li class="page-item active">
                            <span class="page-link">{{ $i }}</span>
                        </li>

                        @else

                        <li class="page-item">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>

                        @endif

                        @endfor

                        {{-- Next --}}
                        @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}">›</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">›</span>
                        </li>
                        @endif

                </ul>
            </nav>

            @endif
        </div>
    </div>
</div>
@endsection