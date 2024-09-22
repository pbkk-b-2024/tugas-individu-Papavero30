<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use App\Models\User; // Changed Customer to User
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
        return view('sidebarcontent.feedback.create', compact('products', 'users')); // Changed customers to users
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Changed customer_id to user_id
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback created successfully.');
    }

    public function edit(Feedback $feedback)
    {
        $products = Product::all();
        $users = User::all(); // Changed customers to users
        return view('sidebarcontent.feedback.edit', compact('feedback', 'products', 'users')); // Changed customers to users
    }

    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Changed customer_id to user_id
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $feedback->update($request->all());

        return redirect()->route('feedback.index')->with('success', 'Feedback updated successfully.');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}