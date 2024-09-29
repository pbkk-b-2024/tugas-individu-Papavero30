<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action_type',
        'actionable_id',
        'actionable_type',
    ];

    const ACTION_TYPE_ORDER = 'order';
    const ACTION_TYPE_FEEDBACK = 'feedback';
    const ACTION_TYPE_RECOMMENDATION = 'recommendation';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function actionable()
    {
        return $this->morphTo();
    }
}