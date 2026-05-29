<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon'
    ];

    // Relasi ke produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Accessor untuk formatted name
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }
}