@extends('layouts.app')

@section('title', 'Products - LaravelShop')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>✨ Temukan <span class="highlight">Produk Favoritmu</span></h1>
            <p>Dapatkan berbagai produk berkualitas dengan harga terbaik dan diskon menarik setiap harinya!</p>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">{{ $products->total() }}+</span>
                    <span class="stat-label">Produk Tersedia</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Layanan Pelanggan</span>
                </div>
                <div class="stat">
                    <span class="stat-number">Gratis</span>
                    <span class="stat-label">Ongkir Minimal Rp 500k</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-row">
            <div class="filter-categories">
                <button class="filter-chip {{ $category == 'all' ? 'active' : '' }}" 
                        onclick="window.location='{{ route('products.index', array_merge(request()->except('category'), ['category' => 'all'])) }}'">
                    <i class="fas fa-th-large"></i> Semua
                </button>
                @foreach($categories as $cat)
                    @if($cat != 'all')
                    <button class="filter-chip {{ $category == $cat ? 'active' : '' }}" 
                            onclick="window.location='{{ route('products.index', array_merge(request()->except('category'), ['category' => $cat])) }}'">
                        <i class="fas fa-tag"></i> {{ ucfirst($cat) }}
                    </button>
                    @endif
                @endforeach
            </div>
            <div class="filter-search">
                <form method="GET" action="{{ route('products.index') }}" class="search-form">
                    @if(request()->has('category') && request()->category != 'all')
                        <input type="hidden" name="category" value="{{ request()->category }}">
                    @endif
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" class="search-input" placeholder="Cari produk..." value="{{ $search }}">
                        <button type="submit" class="search-btn">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="products-header">
        <div>
            <h2 class="section-title">✨ Produk Unggulan</h2>
            <p class="section-subtitle">Koleksi terbaik pilihan untuk Anda</p>
        </div>
        <div class="result-info">
            <i class="fas fa-box-open me-1"></i> Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
        </div>
    </div>

    @if(session('success'))
        <div class="toast-notif">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Product Grid -->
    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                <!-- Stock Badge -->
                @if($product->stock <= 0)
                    <div class="badge-out">Stok Habis</div>
                @elseif($product->stock <= 5)
                    <div class="badge-limited">Terbatas!</div>
                @endif
                
                <!-- Image -->
                <div class="card-image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="image-placeholder">
                            <i class="fas fa-box-open"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="card-content">
                    <div class="card-top">
                        <span class="category-tag">{{ ucfirst($product->category ?? 'Umum') }}</span>
                        <div class="rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <h3 class="product-title">{{ Str::limit($product->name, 35) }}</h3>
                    <p class="product-description">{{ Str::limit($product->description ?? 'Produk berkualitas tinggi dengan desain modern.', 60) }}</p>
                    <div class="price-row">
                        <span class="product-price">{{ $product->formatted_price }}</span>
                        <span class="stock-status {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                            <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                            {{ $product->stock > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="card-actions">
                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">
                        <i class="far fa-heart"></i> Detail
                    </a>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-bag"></i> Keranjang
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-store-slash fa-4x"></i>
                <h3>Belum Ada Produk</h3>
                <p>Yuk, tambahkan produk pertama Anda!</p>
                <a href="{{ route('home') }}" class="btn-refresh">Refresh Halaman</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="pagination-wrapper">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 80px;
    position: relative;
    overflow: hidden;
}
.hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}
.hero-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
}
.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}
.hero-content h1 {
    font-size: 2.8rem;
    font-weight: 800;
    margin-bottom: 20px;
}
.hero-content .highlight {
    background: linear-gradient(135deg, #ffd700, #ffaa00);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-content p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 40px;
}
.hero-stats {
    display: flex;
    justify-content: center;
    gap: 50px;
    flex-wrap: wrap;
}
.stat {
    text-align: center;
}
.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 800;
}
.stat-label {
    font-size: 0.85rem;
    opacity: 0.8;
}

/* Filter Bar */
.filter-bar {
    background: white;
    border-radius: 60px;
    padding: 8px 20px;
    margin: -30px auto 40px;
    max-width: 1100px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}
.filter-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.filter-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.filter-chip {
    background: #f0f2f5;
    border: none;
    padding: 8px 18px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 500;
    color: #555;
    cursor: pointer;
    transition: all 0.2s;
}
.filter-chip i {
    margin-right: 6px;
}
.filter-chip:hover {
    background: #e0e2e5;
}
.filter-chip.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}
.search-wrapper {
    display: flex;
    align-items: center;
    background: #f0f2f5;
    border-radius: 40px;
    padding: 4px 4px 4px 16px;
}
.search-icon {
    color: #999;
    font-size: 14px;
}
.search-input {
    border: none;
    background: transparent;
    padding: 10px 12px;
    width: 220px;
    outline: none;
    font-size: 14px;
}
.search-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: white;
    padding: 8px 22px;
    border-radius: 40px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.2s;
}
.search-btn:hover {
    transform: scale(1.02);
}

/* Products Header */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
    flex-wrap: wrap;
    gap: 15px;
}
.section-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    background: linear-gradient(135deg, #333, #667eea);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.section-subtitle {
    color: #888;
    margin: 5px 0 0;
    font-size: 14px;
}
.result-info {
    background: #f0f2f5;
    padding: 8px 18px;
    border-radius: 40px;
    font-size: 13px;
    color: #666;
}

/* Toast Notification */
.toast-notif {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    z-index: 1000;
    animation: slideIn 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 28px;
}
.product-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    position: relative;
}
.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 35px rgba(102,126,234,0.15);
}
.badge-out, .badge-limited {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 600;
    z-index: 2;
}
.badge-out {
    background: #dc3545;
    color: white;
}
.badge-limited {
    background: #ffc107;
    color: #333;
}
.card-image {
    height: 220px;
    overflow: hidden;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.product-card:hover .card-image img {
    transform: scale(1.05);
}
.image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0f2f5, #e0e4e8);
}
.image-placeholder i {
    font-size: 60px;
    color: #bbb;
}
.card-content {
    padding: 18px;
}
.card-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.category-tag {
    background: #e8f4f8;
    color: #17a2b8;
    font-size: 10px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 20px;
}
.rating {
    font-size: 10px;
    color: #ffc107;
}
.product-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 8px;
    color: #1a1a2e;
}
.product-description {
    font-size: 0.75rem;
    color: #777;
    margin-bottom: 15px;
    line-height: 1.4;
}
.price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
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
.card-actions {
    display: flex;
    gap: 12px;
    padding: 0 18px 18px;
}
.btn-detail, .btn-cart {
    flex: 1;
    padding: 10px;
    border-radius: 40px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    display: inline-block;
}
.btn-detail {
    background: transparent;
    border: 1px solid #667eea;
    color: #667eea;
}
.btn-detail:hover {
    background: #667eea;
    color: white;
}
.btn-cart {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: white;
}
.btn-cart:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 10px rgba(102,126,234,0.3);
}
.btn-cart:disabled {
    background: #ccc;
    cursor: not-allowed;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    background: white;
    border-radius: 24px;
}
.empty-state i {
    color: #ddd;
    margin-bottom: 20px;
}
.btn-refresh {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 24px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 40px;
    text-decoration: none;
}

/* Pagination */
.pagination-wrapper {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}
.pagination {
    gap: 8px;
}
.pagination .page-link {
    border-radius: 10px;
    color: #667eea;
    border: 1px solid #dee2e6;
    padding: 8px 16px;
}
.pagination .page-link:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
}
.pagination .active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: transparent;
    color: white;
}

/* Responsive */
@media (max-width: 992px) {
    .filter-row {
        flex-direction: column;
        align-items: stretch;
    }
    .filter-categories {
        justify-content: center;
    }
    .search-wrapper {
        width: 100%;
    }
    .search-input {
        flex: 1;
    }
}
@media (max-width: 768px) {
    .hero-section {
        padding: 40px 0 60px;
    }
    .hero-content h1 {
        font-size: 1.8rem;
    }
    .hero-stats {
        gap: 30px;
    }
    .products-header {
        flex-direction: column;
        align-items: flex-start;
    }
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    }
}
</style>

<script>
// Auto hide toast after 3 seconds
setTimeout(() => {
    let toast = document.querySelector('.toast-notif');
    if (toast) toast.style.display = 'none';
}, 3000);
</script>
@endsection