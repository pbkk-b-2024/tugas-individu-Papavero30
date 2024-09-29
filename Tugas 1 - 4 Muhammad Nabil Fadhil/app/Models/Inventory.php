<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'ingredient',
        'quantity_available',
        'last_updated',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}