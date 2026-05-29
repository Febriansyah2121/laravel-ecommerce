<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'image', 'category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope untuk filter kategori (tambah tipe data)
    public function scopeByCategory(Builder $query, ?string $categorySlug): Builder
    {
        if ($categorySlug && $categorySlug != 'all') {
            return $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        return $query;
    }

    // Scope untuk pencarian (tambah tipe data)
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('description', 'LIKE', "%{$search}%");
        }
        return $query;
    }

    // Format harga
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Cek stok
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}