@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', '📁 Daftar Kategori')

@section('content')
<div class="bg-white rounded-2xl shadow-soft overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center flex-wrap gap-4">
        <div>
            <h2 class="text-xl font-semibold">Semua Kategori</h2>
            <p class="text-slate-500 text-sm mt-1">Kelola kategori produk</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="px-5 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition inline-flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Kategori
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr class="text-left text-gray-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nama Kategori</th>
                    <th class="px-6 py-3">Slug</th>
                    <th class="px-6 py-3">Jumlah Produk</th>
                    <th class="px-6 py-3">Icon</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $category->id }}</td>
                    <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                            {{ $category->products_count }} produk
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($category->icon)
                            <i class="{{ $category->icon }} text-xl"></i>
                        @else
                            <span class="text-slate-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-sm hover:bg-yellow-600 transition">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus kategori ini? Semua produk dalam kategori ini akan kehilangan kategori.')">
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
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        <i class="fas fa-folder-open text-4xl mb-3 block"></i>
                        <p>Belum ada kategori</p>
                        <a href="{{ route('admin.categories.create') }}" class="mt-2 inline-block text-brand-orange hover:underline">Tambah kategori pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 border-t border-slate-100">
        {{ $categories->links() }}
    </div>
</div>
@endsection