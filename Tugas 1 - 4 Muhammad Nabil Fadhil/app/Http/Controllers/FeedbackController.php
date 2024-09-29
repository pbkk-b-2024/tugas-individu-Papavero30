<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use App\Models\User; // Changed Customer to User
use App\Models\Order; // Added import for Order model
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $feedbacks = Feedback::with('user', 'product') // Changed customer to user
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) { // Changed customer to user
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('rating', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.feedback.index', compact('feedbacks'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all(); // Changed customers to users
        $orders = Order::all(); // Added orders
        return view('sidebarcontent.feedback.create', compact('products', 'users', 'orders')); // Changed customers to users and added orders
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

    $user = Auth::user();
    $order = Order::findOrFail($request->order_id);

    // Ensure the order belongs to the user
    if ($order->user_id !== $user->id) {
        return redirect()->back()->withErrors('You can only submit feedback for your own orders.');
    }

    // Ensure the user hasn't already submitted feedback for this order
    if (Feedback::where('user_id', $user->id)->where('order_id', $request->order_id)->exists()) {
        return redirect()->back()->withErrors('You have already submitted feedback for this order.');
    }

    Feedback::create([
        'user_id' => $user->id,
        'product_id' => $request->product_id,
        'order_id' => $request->order_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('feedback.index')->with('success', 'Feedback created successfully.');
}

    public function edit(Feedback $feedback)
    {
        $products = Product::all();
        $users = User::all(); // Changed customers to users
        $orders = Order::all(); // Added orders
        return view('sidebarcontent.feedback.edit', compact('feedback', 'products', 'users', 'orders')); // Changed customers to users and added orders
    }

    public function update(Request $request, Feedback $feedback)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'order_id' => 'required|exists:orders,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string',
    ]);

    // Ensure the user_id is not changed
    $feedback->update([
        'product_id' => $request->product_id,
        'order_id' => $request->order_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
}

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}