@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-orange-500">Home</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('products.index') }}" class="hover:text-orange-500">Products</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-gray-800">{{ $product->name }}</span>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div class="bg-gray-100 rounded-2xl p-8 flex items-center justify-center">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="max-w-full max-h-96 object-contain">
            @else
                <i class="fas fa-box-open text-8xl text-gray-400"></i>
            @endif
        </div>
        
        <!-- Product Info -->
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
            <div class="flex items-center gap-2 mb-4">
                <div class="flex text-yellow-500">★★★★★</div>
                <span class="text-gray-400">(12 reviews)</span>
                @if($product->stock > 0)
                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">In Stock</span>
                @else
                    <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Out of Stock</span>
                @endif
            </div>
            <div class="text-3xl font-bold text-orange-500 mb-4">{{ $product->formatted_price }}</div>
            <p class="text-gray-600 mb-6">{{ $product->description ?? 'Produk berkualitas tinggi dengan desain modern. Tersedia dalam berbagai pilihan.' }}</p>
            
            <!-- Quantity & Add to Cart -->
            <div class="flex items-center gap-4 mb-6">
                <div class="flex items-center border rounded-lg">
                    <button type="button" onclick="decrementQty()" class="px-3 py-2 border-r hover:bg-gray-100">-</button>
                    <input type="number" id="qty" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-0 focus:outline-none">
                    <button type="button" onclick="incrementQty()" class="px-3 py-2 border-l hover:bg-gray-100">+</button>
                </div>
                <button onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}')" class="px-8 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">
                    <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                </button>
            </div>
            
            <!-- Stock Info -->
            <div class="text-sm text-gray-500">
                <i class="fas fa-box"></i> Stok tersisa: {{ $product->stock }} pcs
            </div>
        </div>
    </div>
    
    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Produk Terkait</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $related)
            <a href="{{ route('products.show', $related->id) }}" class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition group">
                <div class="h-40 bg-gray-100 flex items-center justify-center">
                    @if($related->image)
                        <img src="{{ asset('storage/' . $related->image) }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-box text-4xl text-gray-400"></i>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-semibold">{{ $related->name }}</h3>
                    <div class="text-orange-500 font-bold mt-2">{{ $related->formatted_price }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
function decrementQty() {
    let qty = document.getElementById('qty');
    let val = parseInt(qty.value);
    if (val > 1) qty.value = val - 1;
}

function incrementQty() {
    let qty = document.getElementById('qty');
    let val = parseInt(qty.value);
    let max = parseInt(qty.getAttribute('max'));
    if (val < max) qty.value = val + 1;
}

function addToCart(id, name) {
    let qty = document.getElementById('qty').value;
    fetch('/cart/add/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantity: parseInt(qty) })
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