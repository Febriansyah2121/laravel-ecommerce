<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // Relasi ke views
    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    // Method untuk menambah view (tracking klik)
    public function recordView()
    {
        $this->views()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    // Method untuk mendapatkan total views
    public function getTotalViewsAttribute()
    {
        return $this->views()->count();
    }

    // Method untuk mendapatkan views hari ini
    public function getTodayViewsAttribute()
    {
        return $this->views()->whereDate('created_at', today())->count();
    }

    // Scope untuk filter kategori
    public function scopeByCategory($query, $categorySlug)
    {
        if ($categorySlug && $categorySlug != 'all') {
            return $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        return $query;
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('description', 'LIKE', "%{$search}%");
        }
        return $query;
    }

    // Format harga
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Cek stok
    public function isInStock()
    {
        return $this->stock > 0;
    }
}