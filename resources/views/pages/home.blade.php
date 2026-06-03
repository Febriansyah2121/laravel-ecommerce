@extends('layouts.app')

@section('title', 'Shopcart - Modern E-commerce')

@section('content')
<!-- HERO SECTION -->
<section id="home" class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-700 text-white py-20 md:py-28">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-2 bg-white/20 rounded-full text-sm font-semibold mb-4">🔥 Limited Offer</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-4">Grab Upto <span class="text-yellow-300">50% Off</span> On Selected Headphone</h1>
                <p class="text-lg text-white/90 mb-8">Premium sound, premium feel. Wireless headphones picked for music lovers.</p>
                <div class="flex gap-4">
                    <a href="#products" class="px-6 py-3 bg-orange-500 rounded-full font-semibold hover:bg-orange-600 transition shadow-lg">Shop Now</a>
                    <a href="#products" class="px-6 py-3 bg-white/20 rounded-full font-semibold hover:bg-white/30 transition">Learn More</a>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-64 h-64 md:w-80 md:h-80 bg-white/10 rounded-full flex items-center justify-center backdrop-blur">
                    <div class="text-7xl md:text-8xl">🎧</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TOP CATEGORIES -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Shop Our Top Categories</h2>
            <p class="text-gray-500">Browse our best collections</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5">
            @php
                $categories = [
                    ['name' => 'Furniture', 'icon' => '🛋️', 'color' => 'orange', 'items' => '240', 'slug' => 'rumah'],
                    ['name' => 'Hand Bag', 'icon' => '👜', 'color' => 'pink', 'items' => '240', 'slug' => 'fashion'],
                    ['name' => 'Books', 'icon' => '📚', 'color' => 'blue', 'items' => '240', 'slug' => 'buku'],
                    ['name' => 'Tech', 'icon' => '💻', 'color' => 'violet', 'items' => '240', 'slug' => 'elektronik'],
                    ['name' => 'Sneakers', 'icon' => '👟', 'color' => 'green', 'items' => '240', 'slug' => 'olahraga'],
                    ['name' => 'Travel', 'icon' => '🧳', 'color' => 'yellow', 'items' => '240', 'slug' => 'travel']
                ];
            @endphp
            @foreach($categories as $cat)
            <a href="#products" class="group text-center p-5 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-lg transition-all duration-300" onclick="filterProducts('{{ $cat['slug'] }}'); return false;">
                <div class="w-16 h-16 mx-auto rounded-full bg-{{ $cat['color'] }}-100 flex items-center justify-center text-3xl group-hover:scale-110 transition">
                    {{ $cat['icon'] }}
                </div>
                <h3 class="font-semibold mt-3 text-gray-800">{{ $cat['name'] }}</h3>
                <p class="text-xs text-gray-400 mt-1">{{ $cat['items'] }} Items Available</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CHOOSE BY BRAND -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">Choose by Brand</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
            @php
                $brands = [
                    ['name' => 'Staples', 'icon' => 'S', 'color' => 'red'],
                    ['name' => 'Sprouts', 'icon' => 'SP', 'color' => 'green'],
                    ['name' => 'Grocery Outlet', 'icon' => 'GO', 'color' => 'yellow'],
                    ['name' => 'Bevmo', 'icon' => 'B', 'color' => 'blue'],
                    ['name' => 'Quicklly', 'icon' => 'Q', 'color' => 'purple']
                ];
            @endphp
            @foreach($brands as $brand)
            <div class="bg-white rounded-2xl p-5 text-center shadow-sm hover:shadow-lg transition">
                <div class="w-14 h-14 mx-auto rounded-xl bg-{{ $brand['color'] }}-500 text-white flex items-center justify-center font-bold text-xl">{{ $brand['icon'] }}</div>
                <h3 class="font-semibold mt-3">{{ $brand['name'] }}</h3>
                <p class="text-xs text-green-600 mt-2">✓ Delivery within 24 hours</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section id="products" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">🔥 Featured Products</h2>
            <p class="text-gray-500">Discover our handpicked collection</p>
        </div>
        
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <button onclick="filterProducts('all')" class="filter-btn px-5 py-2 rounded-full bg-orange-500 text-white font-semibold transition">All Products</button>
            <button onclick="filterProducts('elektronik')" class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-orange-500 hover:text-white transition">Elektronik</button>
            <button onclick="filterProducts('fashion')" class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-orange-500 hover:text-white transition">Fashion</button>
            <button onclick="filterProducts('olahraga')" class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-orange-500 hover:text-white transition">Olahraga</button>
            <button onclick="filterProducts('rumah')" class="filter-btn px-5 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-orange-500 hover:text-white transition">Rumah</button>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="productsGrid">
            @php
                $products = \App\Models\Product::with('category')->take(8)->get();
            @endphp
            @foreach($products as $product)
            <div class="product-card-item bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group" data-category="{{ $product->category->slug ?? 'umum' }}">
                <a href="{{ route('products.show', $product->id) }}" class="block">
                    <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <i class="fas fa-box text-5xl text-gray-400"></i>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg product-name hover:text-orange-500 transition">{{ $product->name }}</h3>
                        <div class="flex items-center gap-1 text-yellow-500 text-sm my-2">★★★★★ <span class="text-gray-400 ml-2">(12 reviews)</span></div>
                        <div class="text-xl font-bold text-orange-500 mb-3">{{ $product->formatted_price }}</div>
                    </div>
                </a>
                <div class="px-4 pb-4">
                    <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="add-to-cart-btn w-full py-2 bg-orange-500 text-white rounded-full text-sm font-semibold hover:bg-orange-600 transition flex items-center justify-center gap-2">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">
                View All Products <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- PROMO 70% OFF -->
<section class="py-16 bg-gradient-to-r from-orange-50 to-pink-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-orange-500 font-semibold text-sm">Hurry up!</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Get Up to <span class="text-orange-500">70% Off</span></h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $promos = [
                    ['save' => '$100', 'bg' => 'from-orange-100 to-orange-200', 'text' => 'orange'],
                    ['save' => '$29', 'bg' => 'from-blue-100 to-blue-200', 'text' => 'blue'],
                    ['save' => '$67', 'bg' => 'from-green-100 to-green-200', 'text' => 'green'],
                    ['save' => '$59', 'bg' => 'from-pink-100 to-pink-200', 'text' => 'pink']
                ];
            @endphp
            @foreach($promos as $promo)
            <div class="bg-gradient-to-br {{ $promo['bg'] }} rounded-2xl p-6 hover:scale-105 transition duration-300">
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-2xl mb-4">🏷️</div>
                <p class="text-{{ $promo['text'] }}-600 font-bold text-sm">SAVE {{ $promo['save'] }}</p>
                <h3 class="font-bold text-lg mt-2">Explore Our Furniture & Home Furnishing Range</h3>
                <a href="#products" class="inline-block mt-4 text-gray-700 font-semibold hover:text-orange-500 transition">Shop now →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BEST SELLING STORE -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center mb-12">Best Selling Store</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stores = [
                    ['name' => 'Staples', 'icon' => 'S', 'color' => 'red', 'product' => 'Premium Bag', 'price' => 45],
                    ['name' => 'Now Delivery', 'icon' => 'N', 'color' => 'blue', 'product' => 'Perfume', 'price' => 32],
                    ['name' => 'Bevmo', 'icon' => 'B', 'color' => 'purple', 'product' => 'Travel Bag', 'price' => 67],
                    ['name' => 'Quicklly', 'icon' => 'Q', 'color' => 'green', 'product' => 'Perfume Lux', 'price' => 54]
                ];
            @endphp
            @foreach($stores as $store)
            <div class="bg-white rounded-2xl p-5 shadow-md hover:shadow-xl transition">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-{{ $store['color'] }}-500 text-white flex items-center justify-center font-bold text-lg">{{ $store['icon'] }}</div>
                    <div>
                        <h3 class="font-semibold">{{ $store['name'] }}</h3>
                        <p class="text-xs text-gray-500">Free delivery</p>
                    </div>
                </div>
                <div class="mt-4 bg-{{ $store['color'] }}-50 rounded-xl p-4 flex items-center justify-between">
                    <span class="text-3xl">🛍️</span>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $store['product'] }}</p>
                        <p class="font-bold">${{ $store['price'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="py-16 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-2xl hover:bg-white/10 transition">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">❓</div>
                <h3 class="text-xl font-semibold mb-2">Frequently Asked Questions</h3>
                <p class="text-gray-400">Updates on safe Shopping in our Stores</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:bg-white/10 transition">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">💳</div>
                <h3 class="text-xl font-semibold mb-2">Online Payment Process</h3>
                <p class="text-gray-400">Secure and easy online payments</p>
            </div>
            <div class="text-center p-6 rounded-2xl hover:bg-white/10 transition">
                <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">🚚</div>
                <h3 class="text-xl font-semibold mb-2">Home Delivery Options</h3>
                <p class="text-gray-400">Fast and reliable home delivery</p>
            </div>
        </div>
    </div>
</section>

<script>
function filterProducts(category) {
    const products = document.querySelectorAll('.product-card-item');
    products.forEach(product => {
        const productCategory = product.getAttribute('data-category');
        if (category === 'all' || productCategory === category) {
            product.style.display = '';
        } else {
            product.style.display = 'none';
        }
    });
    
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-orange-500', 'text-white');
        btn.classList.add('bg-gray-200', 'text-gray-700');
    });
    if (event && event.target) {
        event.target.classList.remove('bg-gray-200', 'text-gray-700');
        event.target.classList.add('bg-orange-500', 'text-white');
    }
}

function addToCart(id, name) {
    event.stopPropagation();
    
    fetch('/cart/add/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ quantity: 1 })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart!',
                text: name + ' added to your cart.',
                timer: 2000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true,
                background: '#0F172A',
                color: '#fff',
                iconColor: '#FF7A00'
            });
            
            // Update cart badge
            const cartBadge = document.getElementById('cartCount');
            if (cartBadge) {
                cartBadge.innerText = data.cart_count;
                cartBadge.style.display = 'flex';
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: data.message || 'Could not add item to cart.',
                confirmButtonColor: '#FF7A00'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong. Please try again.',
            confirmButtonColor: '#FF7A00'
        });
    });
}

// Search function
const searchInput = document.getElementById('globalSearch');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const productCards = document.querySelectorAll('.product-card-item');
        productCards.forEach(card => {
            const productName = card.querySelector('.product-name')?.innerText.toLowerCase() || '';
            if (productName.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
}
</script>
@endsection