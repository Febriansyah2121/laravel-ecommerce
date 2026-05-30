@extends('layouts.app')

@section('title', 'Products - LaravelShop')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0 rounded-4 sticky-sidebar">
                <div class="card-header bg-white border-0 pt-4 pb-2">
                    <h5 class="fw-bold mb-0"><i class="fas fa-filter text-primary me-2"></i> Kategori</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('products.index', array_merge(request()->except('category'), ['category' => 'all'])) }}" 
                           class="list-group-item list-group-item-action border-0 py-2 px-0 d-flex align-items-center justify-content-between {{ $category == 'all' ? 'text-primary fw-bold' : '' }}">
                            <span><i class="fas fa-th-large me-2 {{ $category == 'all' ? 'text-primary' : 'text-muted' }}"></i> Semua Produk</span>
                            <span class="badge bg-light text-dark rounded-pill">{{ $products->total() }}</span>
                        </a>
                        @foreach($categories as $cat)
                            @if($cat != 'all')
                            <a href="{{ route('products.index', array_merge(request()->except('category'), ['category' => $cat])) }}" 
                               class="list-group-item list-group-item-action border-0 py-2 px-0 d-flex align-items-center justify-content-between {{ $category == $cat ? 'text-primary fw-bold' : '' }}">
                                <span><i class="fas fa-tag me-2 {{ $category == $cat ? 'text-primary' : 'text-muted' }}"></i> {{ ucfirst($cat) }}</span>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                <hr class="my-2">
                <div class="card-body pt-0">
                    <h5 class="fw-bold mb-3"><i class="fas fa-search text-primary me-2"></i> Cari Produk</h5>
                    <form method="GET" action="{{ route('products.index') }}">
                        @if(request()->has('category') && request()->category != 'all')
                            <input type="hidden" name="category" value="{{ request()->category }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control border-end-0 rounded-start-pill" 
                                   placeholder="Cari produk..." value="{{ $search }}">
                            <button class="btn btn-primary rounded-end-pill" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="col-lg-9">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-0"><i class="fas fa-box-open text-primary me-2"></i> Produk Kami</h2>
                    <p class="text-muted small mb-0 mt-1">
                        <i class="fas fa-chart-line me-1"></i> Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                    </p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-light border rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-sort-amount-down-alt me-1"></i> Urutkan
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Terbaru</a></li>
                        <li><a class="dropdown-item" href="#">Harga Terendah</a></li>
                        <li><a class="dropdown-item" href="#">Harga Tertinggi</a></li>
                        <li><a class="dropdown-item" href="#">Terlaris</a></li>
                    </ul>
                </div>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Product Cards -->
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-6 col-xl-4">
                        <div class="card product-card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <!-- Stock Badge -->
                            @if($product->stock <= 0)
                                <div class="badge-stock badge-sold">Stok Habis</div>
                            @elseif($product->stock <= 5)
                                <div class="badge-stock badge-limited">Terbatas!</div>
                            @endif
                            
                            <!-- Product Image -->
                            <div class="product-image-wrapper">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                                @else
                                    <div class="product-image-placeholder">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge-category">{{ ucfirst($product->category->name ?? 'Umum') }}</span>
                                    <div class="rating">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                </div>
                                <h5 class="product-title">{{ Str::limit($product->name, 40) }}</h5>
                                <p class="product-desc">{{ Str::limit($product->description ?? 'Tidak ada deskripsi', 50) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">{{ $product->formatted_price }}</span>
                                    <span class="stock-status {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                                        <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                        {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Actions -->
                            <div class="card-footer bg-white border-0 pb-3 px-3 pt-0">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">
                                        <i class="far fa-eye me-1"></i> Detail
                                    </a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-cart w-100" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-bag me-1"></i> Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                            <h4>Belum ada produk</h4>
                            <p class="text-muted">Silakan cek kembali nanti atau coba kategori lain.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-sync-alt me-2"></i> Refresh
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination - RAPI DAN MODERN -->
            <div class="pagination-wrapper">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<style>
/* Product Card Styles */
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

/* Badges */
.badge-stock {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    z-index: 2;
}
.badge-sold {
    background: #dc3545;
    color: white;
}
.badge-limited {
    background: #ffc107;
    color: #333;
}

/* Product Image */
.product-image-wrapper {
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}
.product-card:hover .product-image {
    transform: scale(1.05);
}
.product-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
}
.product-image-placeholder i {
    font-size: 60px;
    color: #ccc;
}

/* Badge Category */
.badge-category {
    background: #e8f4f8;
    color: #17a2b8;
    font-size: 10px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
}

/* Product Text */
.product-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #1a1a2e;
}
.product-desc {
    font-size: 0.75rem;
    color: #6c757d;
    margin-bottom: 12px;
    line-height: 1.4;
}
.product-price {
    font-size: 1.1rem;
    font-weight: 800;
    color: #ff6b35;
}
.stock-status {
    font-size: 0.7rem;
    font-weight: 500;
}
.in-stock {
    color: #28a745;
}
.out-stock {
    color: #dc3545;
}
.rating {
    font-size: 0.7rem;
    color: #ffc107;
}

/* Buttons */
.btn-detail {
    flex: 1;
    background: transparent;
    border: 1px solid #667eea;
    color: #667eea;
    padding: 8px 12px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-block;
}
.btn-detail:hover {
    background: #667eea;
    color: white;
}
.btn-cart {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: white;
    padding: 8px 12px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}
.btn-cart:hover:not(:disabled) {
    transform: scale(1.02);
    box-shadow: 0 4px 10px rgba(102,126,234,0.3);
}
.btn-cart:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Sticky Sidebar */
.sticky-sidebar {
    position: sticky;
    top: 90px;
}

/* Pagination Styles - RAPI DAN MODERN */
.pagination-wrapper {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}
.pagination {
    display: flex;
    justify-content: center;
    gap: 6px;
    flex-wrap: wrap;
}
.pagination .page-item {
    list-style: none;
}
.pagination .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 38px;
    height: 38px;
    padding: 0 10px;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    color: #555;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}
.pagination .page-link:hover {
    background: #667eea;
    border-color: #667eea;
    color: white;
}
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: transparent;
    color: white;
}
.pagination .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}
.pagination .page-link i,
.pagination .page-link svg {
    font-size: 12px;
}

/* Empty State */
.empty-state {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 50px;
}

/* Responsive */
@media (max-width: 768px) {
    .product-image-wrapper {
        height: 180px;
    }
    .pagination .page-link {
        min-width: 34px;
        height: 34px;
        font-size: 12px;
    }
}

@media (max-width: 576px) {
    .pagination {
        gap: 4px;
    }
    .pagination .page-link {
        min-width: 32px;
        height: 32px;
        font-size: 11px;
        padding: 0 6px;
    }
}
</style>
@endsection