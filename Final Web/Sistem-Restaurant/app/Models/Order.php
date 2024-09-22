<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'order_date',
        'order_type',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Add validation rules for order type
    public static function boot()
    {
        parent::boot();

        static::saving(function ($order) {
            if (!in_array($order->order_type, ['Dine In', 'Take Away'])) {
                throw new \Exception("Invalid order type.");
            }
        });

        static::created(function ($order) {
            // Automatically create order details and reduce inventory
            foreach ($order->products as $product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                ]);

                foreach ($product->ingredients as $ingredient) {
                    $inventory = Inventory::where('product_id', $product->id)
                                          ->where('ingredient', $ingredient)
                                          ->first();
                    if ($inventory) {
                        $inventory->decrement('quantity_available', $product->pivot->quantity);
                    }
                }
            }
        });

        static::updated(function ($order) {
            // Update order details and reduce inventory
            $order->orderDetails()->delete();
            foreach ($order->products as $product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                ]);

                foreach ($product->ingredients as $ingredient) {
                    $inventory = Inventory::where('product_id', $product->id)
                                          ->where('ingredient', $ingredient)
                                          ->first();
                    if ($inventory) {
                        $inventory->decrement('quantity_available', $product->pivot->quantity);
                    }
                }
            }
        });

        static::created(function ($order) {
            Action::create([
                'user_id' => $order->user_id,
                'action_type' => Action::ACTION_TYPE_ORDER,
                'actionable_id' => $order->id,
                'actionable_type' => Order::class,
            ]);
        });
    }
}