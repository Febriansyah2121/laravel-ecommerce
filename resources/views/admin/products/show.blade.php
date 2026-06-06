@extends('layouts.admin')

@section('title', 'Product Details')
@section('page-title', '📦 Product Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
            <p class="text-slate-500 text-sm mt-1">Product details and information</p>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3">Product Information</h3>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <p><strong>ID:</strong> {{ $product->id }}</p>
                        <p><strong>Name:</strong> {{ $product->name }}</p>
                        <p><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>
                        <p><strong>Price:</strong> <span class="text-orange-500 font-bold">{{ $product->formatted_price }}</span></p>
                        <p><strong>Stock:</strong> {{ $product->stock }} units</p>
                        <p><strong>Description:</strong> {{ $product->description ?? 'No description' }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-3">Product Image</h3>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="max-w-full max-h-64 mx-auto rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">Back to Products</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="px-6 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition">Edit Product</a>
            </div>
        </div>
    </div>
</div>
@endsection