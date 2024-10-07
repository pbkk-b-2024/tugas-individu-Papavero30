<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'ingredients',
        'image',
    ];

    protected $casts = [
        'ingredients' => 'array', // Cast ingredients as array
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    public function supplierProducts()
    {
        return $this->hasMany(SupplierProduct::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}