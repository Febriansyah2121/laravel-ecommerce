@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', '➕ Tambah Produk Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-xl font-semibold">Form Tambah Produk</h2>
            <p class="text-slate-500 text-sm mt-1">Isi data produk dengan lengkap</p>
        </div>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="name" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:border-transparent @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="category_id" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Harga <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500">Rp</span>
                        <input type="number" name="price" class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange @error('price') border-red-500 @enderror" value="{{ old('price') }}" required>
                    </div>
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange @error('stock') border-red-500 @enderror" value="{{ old('stock', 0) }}" required>
                    @error('stock')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-orange">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Gambar Produk</label>
                    <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-brand-orange transition">
                        <i class="fas fa-cloud-upload-alt text-3xl text-slate-400 mb-2"></i>
                        <p class="text-slate-500">Klik atau drag & drop gambar</p>
                        <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, WEBP (Max 2MB)</p>
                        <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" onchange="previewImage(this)">
                        <button type="button" onclick="document.getElementById('imageInput').click()" class="mt-3 px-4 py-2 rounded-lg bg-slate-100 text-sm hover:bg-slate-200 transition">Pilih Gambar</button>
                    </div>
                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-sm text-green-600"><i class="fas fa-check-circle"></i> Gambar dipilih: <span id="fileName"></span></p>
                    </div>
                    @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold hover:bg-slate-300 transition">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-full bg-brand-orange text-white font-semibold hover:bg-brand-orangeDark transition">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const fileName = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        fileName.innerText = input.files[0].name;
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection