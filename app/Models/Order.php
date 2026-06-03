<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'total_amount',
        'status',
        'payment_method',
        'items'
    ];

    protected $casts = [
        'items' => 'array',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Generate unique order number.
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD-';
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count();
        $number = str_pad($lastOrder + 1, 4, '0', STR_PAD_LEFT);
        return $prefix . $date . '-' . $number;
    }

    /**
     * Get status label.
     */
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