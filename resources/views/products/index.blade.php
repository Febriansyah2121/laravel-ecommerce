@extends('layouts.app')

@section('title', 'Products - Shopcart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-2xl shadow-md p-6 sticky top-20">
                <h5 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-filter text-orange-500"></i> Kategori
                </h5>
                <div class="space-y-2">
                    <a href="{{ route('products.index', ['category' => 'all']) }}" 
                       class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition {{ $category == 'all' ? 'bg-orange-50 text-orange-500 font-semibold' : '' }}">
                        <span><i class="fas fa-th-large mr-2"></i> Semua Produk</span>
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $products->total() }}</span>
                    </a>
                    @foreach($categories as $cat)
                        @if($cat != 'all')
                        <a href="{{ route('products.index', ['category' => $cat]) }}" 
                           class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition {{ $category == $cat ? 'bg-orange-50 text-orange-500 font-semibold' : '' }}">
                            <span><i class="fas fa-tag mr-2"></i> {{ ucfirst($cat) }}</span>
                        </a>
                        @endif
                    @endforeach
                </div>
                
                <hr class="my-6">
                
                <h5 class="font-bold text-lg mb-4 flex items-center gap-2">
                    <i class="fas fa-search text-orange-500"></i> Cari Produk
                </h5>
                <form method="GET" action="{{ route('products.index') }}">
                    @if(request()->has('category') && request()->category != 'all')
                        <input type="hidden" name="category" value="{{ request()->category }}">
                    @endif
                    <div class="flex gap-2">
                        <input type="text" name="search" class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                               placeholder="Cari produk..." value="{{ $search }}">
                        <button type="submit" class="px-5 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="lg:w-3/4">
            <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Produk Kami</h2>
                    <p class="text-gray-500 text-sm mt-1">Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk</p>
                </div>
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-300 rounded-full px-5 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option>Terbaru</option>
                        <option>Harga Terendah</option>
                        <option>Harga Tertinggi</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($products as $product)
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
                            <div class="text-xl font-bold text-orange-500">{{ $product->formatted_price }}</div>
                            <div class="text-sm text-gray-500 mt-2">Stok: {{ $product->stock }}</div>
                        </div>
                    </a>
                    <div class="px-4 pb-4">
                        <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="w-full py-2 bg-orange-500 text-white rounded-full text-sm font-semibold hover:bg-orange-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada produk</p>
                </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

<script>
function addToCart(id, name) {
    event.stopPropagation();
    fetch('/cart/add/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
            setTimeout(() => location.reload(), 1500);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endsection