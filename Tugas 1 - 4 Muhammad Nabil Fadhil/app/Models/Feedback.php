<?php
// Feedback.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'rating',
        'comment',
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($feedback) {
            Action::create([
                'user_id' => $feedback->user_id,
                'action_type' => Action::ACTION_TYPE_FEEDBACK,
                'actionable_id' => $feedback->id,
                'actionable_type' => Feedback::class,
            ]);
        });
    }
}