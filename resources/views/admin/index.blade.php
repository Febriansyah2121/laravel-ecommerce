@extends('layouts.admin')

@section('title', 'Manajemen Produk')
@section('page-title', '📦 Daftar Produk')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Semua Produk</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-box text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            {{-- PERBAIKAN 1: Gunakan category->name bukan category langsung --}}
                            <span class="badge bg-secondary">{{ $product->category->name ?? 'Tanpa Kategori' }}</span>
                        </td>
                        <td>
                            {{-- PERBAIKAN 2: Route sudah benar, biarkan --}}
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="7" class="text-center py-4">Belum ada produk</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $products->links() }}
    </div>
</div>
@endsection