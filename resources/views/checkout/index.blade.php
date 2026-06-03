@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-3">
        <i class="fas fa-credit-card text-orange-500"></i> Checkout
    </h1>

    @php
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;
        foreach ($cart as $id => $details) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $subtotal = $product->price * $details['quantity'];
                $total += $subtotal;
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }
    @endphp

    @if(count($cartItems) == 0)
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Your cart is empty</h3>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-semibold flex items-center gap-2">
                            <i class="fas fa-truck text-orange-500"></i> Shipping Information
                        </h2>
                    </div>
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm" class="p-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="customer_name" id="customer_name" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="customer_email" id="customer_email" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
                                <input type="text" name="postal_code" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Shipping Address *</label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Payment Method *</label>
                                <div class="flex flex-wrap gap-4">
                                    <label class="flex items-center gap-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="cod" checked> Cash on Delivery
                                    </label>
                                    <label class="flex items-center gap-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="transfer"> Bank Transfer
                                    </label>
                                    <label class="flex items-center gap-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="card"> Credit Card
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-20">
                    <div class="p-6 border-b border-gray-100 bg-gray-50">
                        <h2 class="text-xl font-semibold flex items-center gap-2">
                            <i class="fas fa-receipt text-orange-500"></i> Order Summary
                        </h2>
                    </div>
                    <div class="p-6">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between mb-3 text-gray-600">
                            <span>{{ $item['product']->name }} <span class="text-gray-400">x{{ $item['quantity'] }}</span></span>
                            <span class="font-semibold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                        <div class="border-t border-gray-200 my-4 pt-4">
                            <div class="flex justify-between mb-2">
                                <span>Subtotal</span>
                                <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Shipping</span>
                                <span class="text-green-600">Free</span>
                            </div>
                            <div class="border-t border-gray-200 mt-3 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold">Total</span>
                                    <span class="text-xl font-bold text-orange-500">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="placeOrderBtn" class="w-full py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.getElementById('placeOrderBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    
    const fullName = document.getElementById('customer_name')?.value;
    const email = document.getElementById('customer_email')?.value;
    const phone = document.getElementById('customer_phone')?.value;
    const address = document.getElementById('shipping_address')?.value;
    
    if (!fullName || !email || !phone || !address) {
        Swal.fire({
            icon: 'error',
            title: 'Incomplete Information',
            text: 'Please fill in all required fields.',
            confirmButtonColor: '#FF7A00'
        });
        return;
    }
    
    Swal.fire({
        title: 'Confirm Order',
        text: 'Please review your order before confirming.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, Place Order!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('checkoutForm').submit();
        }
    });
});
</script>
@endsection