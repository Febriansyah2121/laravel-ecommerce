@extends('layouts.admin')

@section('title', 'Order Details')
@section('page-title', '📋 Order Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-semibold">Order #{{ $order->order_number }}</h2>
            <p class="text-slate-500 text-sm mt-1">Order details and information</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3">Customer Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <p><strong>Name:</strong> {{ $order->customer_name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}</p>
                        <p><strong>Address:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-3">Order Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                        <p><strong>Status:</strong> 
                            <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                                @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Total Amount:</strong> <span class="text-orange-500 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="font-semibold mb-3">Order Items</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr class="text-left text-slate-500">
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $items = is_string($order->items) ? json_decode($order->items, true) : $order->items; @endphp
                            @if($items && count($items) > 0)
                                @foreach($items as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $item['product_name'] ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">{{ $item['quantity'] ?? 0 }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($item['subtotal'] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="4" class="px-4 py-4 text-center text-slate-500">No items found</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">Back to Orders</a>
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="px-6 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition">Edit Status</a>
            </div>
        </div>
    </div>
</div>
@endsection