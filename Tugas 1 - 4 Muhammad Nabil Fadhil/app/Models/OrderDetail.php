<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'user_id', 
        'quantity',
        'price',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate price based on quantity and product price
    public static function boot()
    {
        parent::boot();

        static::saving(function ($orderDetail) {
            $orderDetail->price = $orderDetail->quantity * $orderDetail->product->price;
        });
    }
}