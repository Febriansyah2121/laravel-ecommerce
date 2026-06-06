@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('page-title', '📦 Order Management')

@section('content')
<div class="bg-white rounded-2xl shadow-soft overflow-hidden">
    <div class="p-6 border-b border-slate-100">
        <h2 class="text-xl font-semibold">All Orders</h2>
        <p class="text-slate-500 text-sm mt-1">Manage customer orders and update status</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-3">Order ID</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Total</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium">{{ $order->order_number }}</td>
                    <td class="px-6 py-4">{{ $order->customer_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $order->customer_email ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $order->customer_phone ?? 'N/A' }}</td>
                    <td class="px-6 py-4 font-semibold text-orange-500">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                            @elseif($order->status == 'delivered') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-sm hover:bg-yellow-600 transition">
                            <i class="fas fa-edit"></i> Edit Status
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-6 py-12 text-center text-slate-500">No orders found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-slate-100">
        {{ $orders->links() }}
    </div>
</div>
@endsection