@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page-title', '📦 Daftar Produk')

@section('content')
<div class="bg-white rounded-2xl shadow-soft overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center flex-wrap gap-4">
        <div>
            <h2 class="text-xl font-semibold">Semua Produk</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola produk yang tersedia di toko</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="px-5 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition inline-flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-left text-slate-600 text-sm">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Nama Produk</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Stok</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-4 text-sm">{{ $product->id }}</td>
                    <td class="px-6 py-4">
                        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                <i class="fas fa-box text-slate-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-sm text-brand-orange font-semibold">{{ $product->formatted_price }}</td>
                    <td class="px-6 py-4 text-sm">{{ $product->stock }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-sm hover:bg-yellow-600 transition">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded-lg bg-red-500 text-white text-sm hover:bg-red-600 transition">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                        <i class="fas fa-box-open text-4xl mb-3 block"></i>
                        <p>Belum ada produk</p>
                        <a href="{{ route('admin.products.create') }}" class="mt-2 inline-block text-brand-orange hover:underline">Tambah produk pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-slate-100">
        {{ $products->links() }}
    </div>
</div>
@endsection