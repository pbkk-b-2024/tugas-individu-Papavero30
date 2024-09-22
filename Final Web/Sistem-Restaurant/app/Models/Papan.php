<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Feedback;
use App\Models\Recommendation;

class Papan extends Model
{
    use HasFactory;

    public static function getDashboardData($user)
    {
        if ($user->hasRole('admin')) {
            return [
                'customerCount' => User::role('customer')->count(),
                'productCount' => Product::count(),
                'averageRating' => Feedback::avg('rating'),
            ];
        } elseif ($user->hasRole('customer')) {
            return [
                'orderCount' => Order::where('user_id', $user->id)->count(),
                'feedbackCount' => Feedback::where('user_id', $user->id)->count(),
                'recommendationCount' => Recommendation::where('user_id', $user->id)->count(),
            ];
        }

        return [];
    }
}