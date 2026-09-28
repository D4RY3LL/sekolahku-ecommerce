<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'order_number', 'total_amount', 'shipping_cost',
        'discount', 'grand_total', 'status', 'payment_method',
        'payment_status', 'shipping_address', 'shipping_courier',
        'shipping_service', 'tracking_number', 'notes',
        'paid_at', 'shipped_at', 'delivered_at'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-warning',
            'paid' => 'bg-info',
            'processing' => 'bg-primary',
            'shipped' => 'bg-info',
            'delivered' => 'bg-success',
            'cancelled' => 'bg-danger'
        ];
        
        return $badges[$this->status] ?? 'bg-secondary';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Pembayaran Diterima',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];
        
        return $labels[$this->status] ?? $this->status;
    }

    public function getPaymentStatusLabelAttribute()
    {
        return $this->payment_status == 'paid' ? 'Lunas' : 'Belum Dibayar';
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return $this->payment_status == 'paid' ? 'bg-success' : 'bg-warning';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function isProcessing()
    {
        return $this->status === 'processing';
    }

    public function isShipped()
    {
        return $this->status === 'shipped';
    }

    public function isDelivered()
    {
        return $this->status === 'delivered';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function canBePaid()
    {
        return $this->status === 'pending' && $this->payment_status === 'pending';
    }

    public static function generateOrderNumber()
    {
        $prefix = 'INV';
        $date = date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->count();
        
        return $prefix . $date . str_pad($lastOrder + 1, 4, '0', STR_PAD_LEFT);
    }
}