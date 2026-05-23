@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body text-center p-4 bg-light" style="min-height: 350px;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" style="max-height: 300px;">
                    @else
                        <i class="fas fa-box-open" style="font-size: 120px; color: #ccc; line-height: 280px;"></i>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <h1>{{ $product->name }}</h1>
            <div class="mb-3">
                <span class="badge bg-secondary"><i class="fas fa-tag"></i> {{ ucfirst($product->category ?? 'Umum') }}</span>
                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                    <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                    {{ $product->stock > 0 ? 'Tersedia ' . $product->stock . ' pcs' : 'Stok Habis' }}
                </span>
            </div>
            <div class="h2 text-primary fw-bold mb-3">{{ $product->formatted_price }}</div>
            <div class="mb-4">
                <h5><i class="fas fa-align-left"></i> Deskripsi Produk</h5>
                <p class="text-muted">{{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}</p>
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-auto">
                        <label class="form-label fw-bold"><i class="fas fa-sort-amount-up"></i> Jumlah</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control" style="width: 80px;">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-lg px-4" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-5">
            <h3 class="mb-4"><i class="fas fa-link"></i> Produk Terkait</h3>
            <div class="row">
                @foreach($relatedProducts as $related)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm text-center">
                            <div class="card-body">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <h6>{{ Str::limit($related->name, 30) }}</h6>
                                <div class="text-primary fw-bold">{{ $related->formatted_price }}</div>
                                <a href="{{ route('products.show', $related->id) }}" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection