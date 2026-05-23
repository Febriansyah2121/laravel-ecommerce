@extends('layouts.app')

@section('title', 'Home - LaravelShop')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1>Selamat Datang di <span class="highlight">LaravelShop</span></h1>
            <p>Temukan berbagai produk berkualitas dengan harga terbaik dan diskon menarik setiap harinya!</p>
            <a href="{{ route('products.index') }}" class="btn-hero">
                Belanja Sekarang <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Featured Products -->
    <div class="section-header">
        <h2>✨ Produk Unggulan</h2>
        <p>Koleksi terbaik pilihan untuk Anda</p>
    </div>
    
    <div class="products-grid">
        @forelse($featuredProducts as $product)
            <div class="product-card">
                <div class="card-image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="image-placeholder">
                            <i class="fas fa-box-open"></i>
                        </div>
                    @endif
                </div>
                <div class="card-content">
                    <h5 class="product-title">{{ Str::limit($product->name, 35) }}</h5>
                    <div class="product-price">{{ $product->formatted_price }}</div>
                    <div class="stock-info {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
                        <i class="fas {{ $product->stock > 0 ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        {{ $product->stock > 0 ? 'Tersedia' : 'Stok Habis' }}
                    </div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Detail</a>
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
            <div class="empty-state">Belum ada produk</div>
        @endforelse
    </div>

    <!-- Popular Products -->
    <div class="section-header mt-5">
        <h2>🔥 Produk Populer</h2>
        <p>Paling banyak dibeli bulan ini</p>
    </div>
    
    <div class="products-grid">
        @forelse($popularProducts as $product)
            <div class="product-card">
                <div class="card-image">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="image-placeholder">
                            <i class="fas fa-box-open"></i>
                        </div>
                    @endif
                </div>
                <div class="card-content">
                    <h5 class="product-title">{{ Str::limit($product->name, 35) }}</h5>
                    <div class="product-price">{{ $product->formatted_price }}</div>
                </div>
                <div class="card-actions">
                    <a href="{{ route('products.show', $product->id) }}" class="btn-detail">Detail</a>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-cart">Keranjang</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">Belum ada produk</div>
        @endforelse
    </div>

    <!-- Categories Section -->
    <div class="categories-section mt-5">
        <div class="section-header">
            <h2>📂 Kategori Produk</h2>
            <p>Temukan produk sesuai kebutuhan Anda</p>
        </div>
        <div class="categories-grid">
            <a href="{{ route('products.index', ['category' => 'elektronik']) }}" class="category-card">
                <i class="fas fa-mobile-alt"></i>
                <h4>Elektronik</h4>
                <span>Lihat Semua →</span>
            </a>
            <a href="{{ route('products.index', ['category' => 'fashion']) }}" class="category-card">
                <i class="fas fa-tshirt"></i>
                <h4>Fashion</h4>
                <span>Lihat Semua →</span>
            </a>
            <a href="{{ route('products.index', ['category' => 'olahraga']) }}" class="category-card">
                <i class="fas fa-futbol"></i>
                <h4>Olahraga</h4>
                <span>Lihat Semua →</span>
            </a>
            <a href="{{ route('products.index', ['category' => 'rumah']) }}" class="category-card">
                <i class="fas fa-home"></i>
                <h4>Rumah Tangga</h4>
                <span>Lihat Semua →</span>
            </a>
        </div>
    </div>

    <!-- Features -->
    <div class="features-section mt-5">
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-truck-fast"></i>
                <h4>Pengiriman Cepat</h4>
                <p>Gratis ongkir minimal belanja Rp 500.000</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-shield-alt"></i>
                <h4>Aman & Terpercaya</h4>
                <p>100% garansi keaslian produk</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-headset"></i>
                <h4>Customer Service</h4>
                <p>Layanan pelanggan 24/7 siap membantu</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-undo-alt"></i>
                <h4>Pengembalian Mudah</h4>
                <p>Garansi 14 hari pengembalian barang</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
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
    margin-bottom: 30px;
}
.btn-hero {
    background: white;
    color: #667eea;
    padding: 12px 32px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: 0.3s;
}
.btn-hero:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 40px;
}
.section-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.section-header p {
    color: #666;
}
/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 25px;
}
.product-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}
.card-image {
    height: 200px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.image-placeholder i {
    font-size: 60px;
    color: #ccc;
}
.card-content {
    padding: 15px;
}
.product-title {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
}
.product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #ff6b35;
}
.stock-info {
    font-size: 0.7rem;
    margin-top: 5px;
}
.in-stock {
    color: #28a745;
}
.out-stock {
    color: #dc3545;
}
.card-actions {
    display: flex;
    gap: 10px;
    padding: 0 15px 15px;
}
.btn-detail, .btn-cart {
    flex: 1;
    padding: 8px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
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
/* Categories Grid */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.category-card {
    background: white;
    padding: 30px;
    border-radius: 16px;
    text-align: center;
    text-decoration: none;
    transition: 0.3s;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}
.category-card:hover {
    transform: translateY(-5px);
}
.category-card i {
    font-size: 40px;
    color: #667eea;
    margin-bottom: 15px;
}
.category-card h4 {
    color: #333;
    margin-bottom: 8px;
}
.category-card span {
    color: #666;
    font-size: 13px;
}
/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.feature-card {
    text-align: center;
    padding: 25px;
    background: white;
    border-radius: 16px;
}
.feature-card i {
    font-size: 40px;
    color: #ff6b35;
    margin-bottom: 15px;
}
.feature-card h4 {
    margin-bottom: 8px;
}
.feature-card p {
    font-size: 13px;
    color: #666;
}
/* Responsive */
@media (max-width: 992px) {
    .categories-grid, .features-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 1.8rem;
    }
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 576px) {
    .categories-grid, .features-grid, .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection