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
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $product->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                               value="{{ old('price', $product->price) }}" required>
                    </div>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" 
                           value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Gambar Saat Ini</label>
                    <div class="current-image-container">
                        @if($product->image && file_exists(storage_path('app/public/' . $product->image)))
                            <div class="current-image-wrapper">
                                <img src="{{ asset('storage/' . $product->image) }}" class="current-image" alt="Current Image">
                                <small class="text-muted d-block mt-1">Gambar saat ini</small>
                            </div>
                        @else
                            <div class="no-image-placeholder">
                                <i class="fas fa-image fa-2x text-muted"></i>
                                <p class="text-muted mb-0">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Ganti Gambar <span class="text-muted">(opsional)</span></label>
                    <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                        <div class="image-upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <p class="mb-1">Klik untuk upload gambar baru</p>
                        <small class="text-muted">Format: JPG, PNG, WEBP. Max 2MB</small>
                        <input type="file" name="image" id="imageInput" class="d-none" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div id="imagePreviewContainer" class="image-preview mt-3" style="display: none;">
                        <div class="preview-label">Preview Gambar Baru:</div>
                        <div class="preview-wrapper">
                            <img id="previewImg" src="#" alt="Preview">
                            <button type="button" class="btn-remove-img" onclick="removeImage()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 pt-2">
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
/* Current Image */
.current-image-container {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px;
    text-align: center;
}
.current-image-wrapper {
    display: inline-block;
}
.current-image {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.no-image-placeholder {
    padding: 20px;
    text-align: center;
    background: #f0f0f0;
    border-radius: 10px;
}

/* Image Upload Area */
.image-upload-area {
    border: 2px dashed #ddd;
    border-radius: 12px;
    padding: 25px;
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
    font-size: 48px;
    color: #667eea;
    margin-bottom: 10px;
}

/* Image Preview */
.image-preview {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 15px;
}
.preview-label {
    font-size: 12px;
    color: #666;
    margin-bottom: 10px;
}
.preview-wrapper {
    position: relative;
    display: inline-block;
}
.preview-wrapper img {
    max-width: 150px;
    max-height: 150px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #28a745;
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
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-remove-img:hover {
    background: #c82333;
}
</style>

<script>
function previewImage(input) {
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('previewImg');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
        previewImg.src = '#';
    }
}

function removeImage() {
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('previewImg');
    
    imageInput.value = '';
    previewContainer.style.display = 'none';
    previewImg.src = '#';
}
</script>
@endsection