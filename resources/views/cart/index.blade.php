@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Shopping Cart</h1>

    @php
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;
        foreach ($cart as $id => $details) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $subtotal = $product->price * $details['quantity'];
                $total += $subtotal;
                $cartItems[] = ['id' => $id, 'product' => $product, 'quantity' => $details['quantity'], 'subtotal' => $subtotal];
            }
        }
    @endphp

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-4">Product</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Quantity</th>
                            <th class="px-6 py-4">Subtotal</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                        @if($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <i class="fas fa-box text-2xl text-gray-400"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold">{{ $item['product']->name }}</h3>
                                        <p class="text-xs text-gray-400">SKU: #{{ $item['product']->id }}</p>
                                    </div>
                                </div>
                             </div>
                            </td>
                            <td class="px-6 py-4">{{ $item['product']->formatted_price }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="/cart/update/{{ $item['id'] }}?qty={{ $item['quantity'] - 1 }}" class="qty-btn w-8 h-8 rounded-full bg-gray-200 hover:bg-orange-500 hover:text-white flex items-center justify-center transition">-</a>
                                    <span class="w-8 text-center font-semibold">{{ $item['quantity'] }}</span>
                                    <a href="/cart/update/{{ $item['id'] }}?qty={{ $item['quantity'] + 1 }}" class="qty-btn w-8 h-8 rounded-full bg-gray-200 hover:bg-orange-500 hover:text-white flex items-center justify-center transition">+</a>
                                </div>
                             </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-orange-500">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <a href="#" onclick="removeItem({{ $item['id'] }}, '{{ addslashes($item['product']->name) }}')" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                             </div>
                         </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 px-6 py-4 flex justify-between items-center flex-wrap gap-4">
                <div class="flex gap-3">
                    <a href="{{ route('products.index') }}" class="px-5 py-2 bg-gray-200 rounded-full font-semibold hover:bg-gray-300 transition">← Continue Shopping</a>
                    <a href="#" onclick="clearCart()" class="px-5 py-2 bg-red-100 text-red-600 rounded-full font-semibold hover:bg-red-200 transition">🗑 Clear Cart</a>
                </div>
                <div class="text-right">
                    <p class="text-lg font-bold">Total: <span class="text-orange-500">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
                    <a href="{{ route('checkout.index') }}" class="inline-block mt-2 px-6 py-2 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">Proceed to Checkout →</a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Your cart is empty</h3>
            <a href="{{ route('products.index') }}" class="inline-block mt-2 px-6 py-2 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">Start Shopping →</a>
        </div>
    @endif
</div>

<script>
function removeItem(id, name) {
    Swal.fire({
        title: 'Remove item?',
        text: `Remove "${name}" from your cart?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF7A00',
        confirmButtonText: 'Yes, remove!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/cart/remove/' + id;
        }
    });
}

function clearCart() {
    Swal.fire({
        title: 'Clear cart?',
        text: 'All items will be removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, clear all!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/cart/clear';
        }
    });
}

document.querySelectorAll('.qty-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = this.getAttribute('href');
        Swal.fire({
            title: 'Update quantity?',
            text: 'Are you sure?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Yes, update!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>
@endsection