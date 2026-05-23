@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container py-5">
    <div class="cart-header mb-4">
        <h1 class="display-6 fw-bold">
            <i class="fas fa-shopping-cart text-primary me-2"></i> Keranjang Belanja
        </h1>
        <p class="text-muted">Review dan checkout pesanan Anda</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-4 pb-2">
                        <h5 class="mb-0 fw-bold">Daftar Produk ({{ count($cartItems) }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th class="pe-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="cart-img">
                                                    @if($item['product']->image)
                                                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}">
                                                    @else
                                                        <div class="img-placeholder">
                                                            <i class="fas fa-box-open"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 fw-bold">{{ $item['product']->name }}</h6>
                                                    <small class="text-muted">Stok: {{ $item['product']->stock }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $item['product']->formatted_price }}</td>
                                        <td class="align-middle">
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="d-flex align-items-center">
                                                @csrf
                                                @method('PUT')
                                                <div class="quantity-wrapper">
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="qty-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="qty-value">{{ $item['quantity'] }}</span>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="qty-btn" {{ $item['quantity'] >= $item['product']->stock ? 'disabled' : '' }}>
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="align-middle fw-bold text-primary">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                        <td class="pe-4 align-middle">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove" onclick="return confirm('Hapus produk ini dari keranjang?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </table>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-2 pb-4">
                        <div class="d-flex justify-content-between align-items-center px-3">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-2"></i> Lanjut Belanja
                            </a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger rounded-pill px-4" onclick="return confirm('Kosongkan seluruh keranjang?')">
                                    <i class="fas fa-trash-alt me-2"></i> Kosongkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-cart">
                    <div class="card-header bg-white border-0 pt-4">
                        <h5 class="mb-0 fw-bold">Ringkasan Belanja</h5>
                    </div>
                    <div class="card-body">
                        <div class="summary-row">
                            <span>Total Harga ({{ count($cartItems) }} item)</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Biaya Pengiriman</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <div class="summary-row border-0 pt-2">
                            <span class="h6 mb-0">Total Bayar</span>
                            <span class="h4 text-primary fw-bold mb-0">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pb-4">
                        <a href="{{ route('checkout.index') }}" class="btn-checkout w-100">
                            <i class="fas fa-credit-card me-2"></i> Checkout Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart State -->
        <div class="empty-cart">
            <div class="empty-cart-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3>Keranjang Belanja Kosong</h3>
            <p>Yuk, mulai belanja produk favorit Anda sekarang!</p>
            <a href="{{ route('products.index') }}" class="btn-shop">
                <i class="fas fa-store me-2"></i> Belanja Sekarang
            </a>
            <div class="empty-cart-suggestions mt-4">
                <h6>Rekomendasi untuk Anda:</h6>
                <div class="suggestion-tags">
                    <span>Elektronik</span>
                    <span>Fashion</span>
                    <span>Olahraga</span>
                    <span>Rumah Tangga</span>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Cart Image */
.cart-img {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    overflow: hidden;
    background: #f0f2f5;
    display: flex;
    align-items: center;
    justify-content: center;
}
.cart-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.img-placeholder i {
    font-size: 28px;
    color: #bbb;
}

/* Quantity Wrapper */
.quantity-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f0f2f5;
    border-radius: 40px;
    padding: 4px 8px;
    width: fit-content;
}
.qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: none;
    background: white;
    cursor: pointer;
    transition: 0.2s;
}
.qty-btn:hover:not(:disabled) {
    background: #667eea;
    color: white;
}
.qty-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
.qty-value {
    min-width: 30px;
    text-align: center;
    font-weight: 600;
}

/* Remove Button */
.btn-remove {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 1rem;
    transition: 0.2s;
}
.btn-remove:hover {
    color: #a71d2a;
    transform: scale(1.1);
}

/* Summary Row */
.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

/* Sticky Cart */
.sticky-cart {
    position: sticky;
    top: 100px;
}

/* Checkout Button */
.btn-checkout {
    display: block;
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    text-align: center;
    padding: 14px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}
.btn-checkout:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(40,167,69,0.3);
    color: white;
}

/* Empty Cart */
.empty-cart {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 24px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}
.empty-cart-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #667eea20, #764ba220);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.empty-cart-icon i {
    font-size: 48px;
    color: #667eea;
}
.empty-cart h3 {
    margin-bottom: 10px;
}
.empty-cart p {
    color: #777;
    margin-bottom: 25px;
}
.btn-shop {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 12px 32px;
    border-radius: 40px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: 0.3s;
}
.btn-shop:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102,126,234,0.3);
}
.suggestion-tags {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 15px;
}
.suggestion-tags span {
    background: #f0f2f5;
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 13px;
    cursor: pointer;
    transition: 0.2s;
}
.suggestion-tags span:hover {
    background: #667eea;
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 13px;
    }
    .cart-img {
        width: 45px;
        height: 45px;
    }
    .quantity-wrapper {
        padding: 2px 6px;
    }
    .qty-btn {
        width: 24px;
        height: 24px;
        font-size: 10px;
    }
}
</style>
@endsection