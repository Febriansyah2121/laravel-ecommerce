@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', '✏️ Edit Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-semibold">Form Edit Kategori</h2>
            <p class="text-slate-500 text-sm mt-1">Ubah data kategori yang sudah ada</p>
        </div>
        
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Nama Kategori <span class="text-red-500">*</span></label>
                <input type="text" name="name" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange" value="{{ old('name', $category->name) }}" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Slug <span class="text-red-500">*</span></label>
                <input type="text" name="slug" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange" value="{{ old('slug', $category->slug) }}" required>
                <p class="text-xs text-slate-400 mt-1">Contoh: elektronik, fashion, olahraga</p>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange">{{ old('description', $category->description) }}</textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-2">Icon (Font Awesome)</label>
                <div class="flex items-center gap-3">
                    <input type="text" name="icon" class="flex-1 px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange" value="{{ old('icon', $category->icon) }}" placeholder="Contoh: fa-mobile-alt">
                    @if($category->icon)
                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                            <i class="{{ $category->icon }} text-xl text-brand-orange"></i>
                        </div>
                    @endif
                </div>
                <p class="text-xs text-slate-400 mt-1">Masukkan class Font Awesome (contoh: fa-mobile-alt, fa-tshirt, fa-futbol)</p>
            </div>
            
            <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition">Update Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection