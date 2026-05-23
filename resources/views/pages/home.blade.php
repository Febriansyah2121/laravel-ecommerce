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
.btn-hero {
    background: white;
    color: #667eea;
    padding: 12px 32px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
}
.section-header {
    text-align: center;
    margin-bottom: 40px;
}
.section-header h2 {
    font-size: 1.8rem;
    font-weight: 700;
}
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
}
.card-image {
    height: 200px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}
.card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.card-content {
    padding: 15px;
}
.product-title {
    font-size: 1rem;
    font-weight: 600;
}
.product-price {
    font-size: 1.1rem;
    font-weight: 700;
    color: #ff6b35;
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
}
.btn-detail {
    background: transparent;
    border: 1px solid #667eea;
    color: #667eea;
}
.btn-cart {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: white;
}
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
}
.category-card span {
    color: #666;
    font-size: 13px;
}
@media (max-width: 768px) {
    .hero-content h1 { font-size: 1.8rem; }
    .categories-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 576px) {
    .products-grid, .categories-grid { grid-template-columns: 1fr; }
}
</style>
@endsection