@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Products</p>
                <p class="text-3xl font-bold">{{ $totalProducts }}</p>
            </div>
            <i class="fas fa-box text-4xl opacity-50"></i>
        </div>
    </div>
    
    <!-- Total Categories -->
    <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Categories</p>
                <p class="text-3xl font-bold">{{ $totalCategories }}</p>
            </div>
            <i class="fas fa-folder text-4xl opacity-50"></i>
        </div>
    </div>
    
    <!-- Total Clicks (dari kolom clicks) -->
    <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Product Clicks</p>
                <p class="text-3xl font-bold">{{ $totalClicks }}</p>
            </div>
            <i class="fas fa-mouse-pointer text-4xl opacity-50"></i>
        </div>
    </div>
    
    <!-- Total Orders -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Total Orders</p>
                <p class="text-3xl font-bold">{{ $totalOrders }}</p>
            </div>
            <i class="fas fa-shopping-cart text-4xl opacity-50"></i>
        </div>
    </div>
    
    <!-- Revenue -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-80">Revenue</p>
                <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
            <i class="fas fa-dollar-sign text-4xl opacity-50"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Recent Orders</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-brand-orange hover:underline">View All →</a>
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
                    @forelse($recentOrders as $order)
                    <tr class="border-b">
                        <td class="py-3">{{ $order->order_number }}</td>
                        <td class="py-3">{{ $order->customer_name ?? 'N/A' }}</td>
                        <td class="py-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
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
    
    <!-- Top Products by Clicks -->
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Most Clicked Products</h3>
            <span class="text-xs text-slate-400">by click count</span>
        </div>
        <div class="space-y-3">
            @forelse($topProducts as $product)
            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-brand-orange/10 text-brand-orange grid place-items-center">
                        <i class="fas fa-box"></i>
                    </div>
                    <div>
                        <p class="font-medium">{{ Str::limit($product->name, 30) }}</p>
                        <p class="text-xs text-slate-500">{{ $product->clicks }} clicks</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-orange-500 font-semibold">{{ $product->formatted_price }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-slate-500">
                <i class="fas fa-chart-line text-4xl mb-2 opacity-50"></i>
                <p>No click data yet</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Views Statistics -->
<div class="mt-6 bg-white rounded-2xl shadow-soft p-6">
    <h3 class="text-lg font-semibold mb-4">Views Statistics</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="text-center p-4 bg-slate-50 rounded-xl">
            <p class="text-sm text-slate-500">Today</p>
            <p class="text-2xl font-bold text-brand-orange">{{ $todayViews }}</p>
        </div>
        <div class="text-center p-4 bg-slate-50 rounded-xl">
            <p class="text-sm text-slate-500">This Week</p>
            <p class="text-2xl font-bold text-brand-orange">{{ $thisWeekViews }}</p>
        </div>
        <div class="text-center p-4 bg-slate-50 rounded-xl">
            <p class="text-sm text-slate-500">This Month</p>
            <p class="text-2xl font-bold text-brand-orange">{{ $thisMonthViews }}</p>
        </div>
    </div>
</div>

<!-- Additional Stats -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <h3 class="text-lg font-semibold mb-4">System Overview</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                <span class="text-slate-600">Total Users</span>
                <span class="font-semibold">{{ $totalUsers }}</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg">
                <span class="text-slate-600">Total Views (ProductView)</span>
                <span class="font-semibold">{{ $totalViews }}</span>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl shadow-soft p-6">
        <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
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
        </div>
    </div>
</div>
@endsection