@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Products</p>
                <p class="text-3xl font-bold">{{ \App\Models\Product::count() }}</p>
            </div>
            <i class="fas fa-box text-4xl opacity-50"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Orders</p>
                <p class="text-3xl font-bold">{{ \App\Models\Order::count() }}</p>
            </div>
            <i class="fas fa-shopping-cart text-4xl opacity-50"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Users</p>
                <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <i class="fas fa-users text-4xl opacity-50"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Revenue</p>
                {{-- PERBAIKAN: ganti 'total' menjadi 'total_amount' --}}
                <p class="text-3xl font-bold">Rp {{ number_format(\App\Models\Order::sum('total_amount'), 0, ',', '.') }}</p>
            </div>
            <i class="fas fa-dollar-sign text-4xl opacity-50"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Recent Orders</h3>
            <a href="#" class="text-sm text-brand-orange">View All →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b">
                    <tr class="text-left text-slate-500">
                        <th class="pb-2">Order ID</th>
                        <th class="pb-2">Customer</th>
                        <th class="pb-2">Total</th>
                        <th class="pb-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Order::latest()->limit(5)->get() as $order)
                    <tr class="border-b">
                        <td class="py-3">{{ $order->order_number }}</td>
                        <td class="py-3">{{ $order->customer_name ?? 'N/A' }}</td>
                        <td class="py-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-4 text-center text-slate-500">No orders yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Quick Actions</h3>
        </div>
        <div class="space-y-3">
            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition">
                <div class="w-10 h-10 rounded-lg bg-brand-orange/10 text-brand-orange grid place-items-center">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <p class="font-medium">Add New Product</p>
                    <p class="text-xs text-slate-500">Create a new product listing</p>
                </div>
            </a>
            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition">
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 text-purple-500 grid place-items-center">
                    <i class="fas fa-folder"></i>
                </div>
                <div>
                    <p class="font-medium">Add New Category</p>
                    <p class="text-xs text-slate-500">Create a new product category</p>
                </div>
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition">
                <div class="w-10 h-10 rounded-lg bg-green-500/10 text-green-500 grid place-items-center">
                    <i class="fas fa-globe"></i>
                </div>
                <div>
                    <p class="font-medium">View Website</p>
                    <p class="text-xs text-slate-500">Go to customer storefront</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection