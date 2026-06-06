@extends('layouts.admin')

@section('title', 'Edit Order Status')
@section('page-title', '✏️ Update Order Status')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-semibold">Order #{{ $order->order_number }}</h2>
            <p class="text-slate-500 text-sm mt-1">Update order status</p>
        </div>
        
        <div class="p-6">
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-2">Customer Information</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p><strong>Name:</strong> {{ $order->customer_name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->customer_email ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $order->shipping_address ?? 'N/A' }}</p>
                    <p><strong>Total:</strong> <span class="text-orange-500 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
                </div>
            </div>
            
            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Order Status</label>
                    <select name="status" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>🟡 Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔵 Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>🟣 Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>🟢 Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>🔴 Cancelled</option>
                    </select>
                </div>
                
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">Back</a>
                    <button type="submit" class="px-6 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection