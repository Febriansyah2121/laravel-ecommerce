@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', '✏️ Edit Produk')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="elektronik" {{ $product->category == 'elektronik' ? 'selected' : '' }}>📱 Elektronik</option>
                        <option value="fashion" {{ $product->category == 'fashion' ? 'selected' : '' }}>👔 Fashion</option>
                        <option value="olahraga" {{ $product->category == 'olahraga' ? 'selected' : '' }}>⚽ Olahraga</option>
                        <option value="rumah" {{ $product->category == 'rumah' ? 'selected' : '' }}>🏠 Rumah Tangga</option>
                        <option value="buku" {{ $product->category == 'buku' ? 'selected' : '' }}>📚 Buku</option>
                        <option value="travel" {{ $product->category == 'travel' ? 'selected' : '' }}>✈️ Travel</option>
                        <option value="aksesoris" {{ $product->category == 'aksesoris' ? 'selected' : '' }}>🎧 Aksesoris</option>
                        <option value="kecantikan" {{ $product->category == 'kecantikan' ? 'selected' : '' }}>💄 Kecantikan</option>
                        <option value="makanan" {{ $product->category == 'makanan' ? 'selected' : '' }}>🍕 Makanan & Minuman</option>
                        <option value="otomotif" {{ $product->category == 'otomotif' ? 'selected' : '' }}>🚗 Otomotif</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $product->image) }}" width="100" class="rounded">
                        </div>
                    @else
                        <p class="text-muted">Tidak ada gambar</p>
                    @endif
                    
                    <label class="form-label mt-2">Ganti Gambar (opsional)</label>
                    <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                        <div class="image-upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <p class="mb-1">Klik untuk upload gambar baru</p>
                        <small class="text-muted">Format: JPG, PNG. Max 2MB</small>
                        <input type="file" name="image" id="imageInput" class="d-none" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div id="imagePreview" class="image-preview mt-3" style="display: none;">
                        <img id="previewImg" src="#" alt="Preview" style="max-width: 150px; border-radius: 10px;">
                        <button type="button" class="btn-remove-img" onclick="removeImage()">&times;</button>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i> Update Produk
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.image-upload-area {
    border: 2px dashed #ddd;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #f8f9fa;
}
.image-upload-area:hover {
    border-color: #667eea;
    background: #f0f2f5;
}
.image-upload-icon i {
    font-size: 40px;
    color: #667eea;
    margin-bottom: 10px;
}
.image-preview {
    position: relative;
    display: inline-block;
}
.btn-remove-img {
    position: absolute;
    top: -10px;
    right: -10px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #dc3545;
    color: white;
    border: none;
    cursor: pointer;
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'inline-block';
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function removeImage() {
    document.getElementById('imageInput').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('previewImg').src = '#';
}
</script>
@endsection