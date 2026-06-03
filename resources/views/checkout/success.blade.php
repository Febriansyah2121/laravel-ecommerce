@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden text-center">
        <div class="p-8">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-green-500 text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Successful!</h1>
            <p class="text-gray-500 mb-6">Thank you for your purchase. Your order has been confirmed.</p>
            
            <div class="bg-gray-50 rounded-xl p-6 mb-6 text-left">
                <h3 class="font-semibold text-gray-800 mb-3">Order Details</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Order Number:</span>
                        <span class="font-semibold">{{ $order->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Customer Name:</span>
                        <span>{{ $order->customer_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email:</span>
                        <span>{{ $order->customer_email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Phone:</span>
                        <span>{{ $order->customer_phone }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Total Amount:</span>
                        <span class="font-bold text-orange-500">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Payment Method:</span>
                        <span>
                            @if($order->payment_method == 'cod') Cash on Delivery
                            @elseif($order->payment_method == 'transfer') Bank Transfer
                            @else Credit Card
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status:</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">{{ $order->status_label }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="px-6 py-3 bg-orange-500 text-white rounded-full font-semibold hover:bg-orange-600 transition">
                    <i class="fas fa-home mr-2"></i> Back to Home
                </a>
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 transition">
                    <i class="fas fa-shopping-bag mr-2"></i> Continue Shopping
                </a>
            </div>
        </div>
    </div>
</div>
@endsection