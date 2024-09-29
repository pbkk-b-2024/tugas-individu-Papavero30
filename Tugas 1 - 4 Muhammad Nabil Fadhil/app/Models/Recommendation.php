<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'recommendation_type',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope to get products with good ratings and high order quantities
    public static function scopePopularProducts($query)
    {
        return $query->select('products.name', 'feedback.rating', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->join('products', 'recommendations.product_id', '=', 'products.id')
            ->join('feedback', 'feedback.product_id', '=', 'products.id')
            ->join('order_details', 'order_details.product_id', '=', 'products.id')
            ->groupBy('products.name', 'feedback.rating')
            ->orderBy('total_quantity', 'desc')
            ->orderBy('feedback.rating', 'desc');
    }
}