<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'product_id',
        'ingredient',
        'price',
        'quantity',
    ];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Automatically update inventory when supplier product is created or updated
    protected static function boot()
    {
        parent::boot();

        static::created(function ($supplierProduct) {
            $inventory = Inventory::where('product_id', $supplierProduct->product_id)
                                  ->where('ingredient', $supplierProduct->ingredient)
                                  ->first();
            if ($inventory) {
                $inventory->increment('quantity_available', $supplierProduct->quantity);
            } else {
                Inventory::create([
                    'product_id' => $supplierProduct->product_id,
                    'ingredient' => $supplierProduct->ingredient,
                    'quantity_available' => $supplierProduct->quantity,
                ]);
            }
        });

        static::updated(function ($supplierProduct) {
            $inventory = Inventory::where('product_id', $supplierProduct->product_id)
                                  ->where('ingredient', $supplierProduct->ingredient)
                                  ->first();
            if ($inventory) {
                $inventory->increment('quantity_available', $supplierProduct->quantity);
            } else {
                Inventory::create([
                    'product_id' => $supplierProduct->product_id,
                    'ingredient' => $supplierProduct->ingredient,
                    'quantity_available' => $supplierProduct->quantity,
                ]);
            }
        });
    }
}