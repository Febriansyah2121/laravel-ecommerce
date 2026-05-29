<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'total', 'status', 'order_number'
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Generate order number
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count();
        $number = str_pad($lastOrder + 1, 4, '0', STR_PAD_LEFT);
        return $prefix . $date . '-' . $number;
    }

    // Format status
    public function getStatusLabelAttribute(): string
    {
        $statuses = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];
        return $statuses[$this->status] ?? ucfirst($this->status);
    }
}