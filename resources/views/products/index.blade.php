@extends('layouts.app')

@section('title', 'Products - LaravelShop')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Kategori</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index', ['category' => 'all']) }}" 
                           class="list-group-item list-group-item-action {{ $category == 'all' ? 'active' : '' }}">
                            Semua Produk
                        </a>
                        @foreach($categories as $cat)
                            @if($cat != 'all')
                            <a href="{{ route('products.index', ['category' => $cat]) }}" 
                               class="list-group-item list-group-item-action {{ $category == $cat ? 'active' : '' }}">
                                {{ ucfirst($cat) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-search"></i> Cari Produk</h5>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ $search }}">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Produk Kami</h2>
                <p class="text-muted">Menampilkan {{ $products->total() }} produk</p>
            </div>

            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-img-top text-center p-3 bg-light" style="height: 180px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid h-100" style="object-fit: contain;">
                                @else
                                    <i class="fas fa-box-open" style="font-size: 60px; line-height: 150px;"></i>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($product->name, 35) }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($product->description ?? 'Tidak ada deskripsi', 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary fw-bold">{{ $product->formatted_price }}</span>
                                    <small class="text-muted">Stok: {{ $product->stock }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pb-3">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">Detail</a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm w-100">Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">Belum ada produk</div>
                    </div>
                @endforelse
            </div>

            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection