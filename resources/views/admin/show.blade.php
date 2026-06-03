@extends('layouts.admin')

@section('title', 'Detail Produk')
@section('page-title', '📦 Detail Produk')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Produk</label>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <p>{{ $product->category->name ?? 'Umum' }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Harga</label>
                    <p class="text-primary fw-bold">{{ $product->formatted_price }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Stok</label>
                    <p>{{ $product->stock }} unit</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <p>{{ $product->description ?? 'Tidak ada deskripsi' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Produk</label>
                    @if($product->image)
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" style="max-width: 300px;">
                        </div>
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection