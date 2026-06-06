<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'clicks'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'clicks' => 'integer',
    ];

    /**
     * Get the category that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the views for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    /**
     * Record a view for this product.
     *
     * @return void
     */
    public function recordView(): void
    {
        $this->views()->create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    /**
     * Get total views count.
     *
     * @return int
     */
    public function getTotalViewsAttribute(): int
    {
        return $this->views()->count();
    }

    /**
     * Get today's views count.
     *
     * @return int
     */
    public function getTodayViewsAttribute(): int
    {
        return $this->views()->whereDate('created_at', today())->count();
    }

    /**
     * Scope a query to filter by category slug.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $categorySlug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory(Builder $query, ?string $categorySlug): Builder
    {
        if ($categorySlug && $categorySlug !== 'all') {
            return $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        return $query;
    }

    /**
     * Scope a query to search products by name or description.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Get formatted price attribute.
     *
     * @return string
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Check if product is in stock.
     *
     * @return bool
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Increment product clicks.
     *
     * @return void
     */
    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }
}