<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');
        $recommendations = Recommendation::popularProducts()
            ->when($search, function ($query, $search) {
                return $query->where('products.name', 'like', "%{$search}%")
                             ->orWhere('feedback.rating', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.recommendations.index', compact('recommendations'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('sidebarcontent.recommendations.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'recommendation_type' => 'nullable|string|in:rule-based,ML-based',
        ]);

        Recommendation::create($request->all());

        return redirect()->route('recommendations.index')->with('success', 'Recommendation created successfully.');
    }

    public function edit(Recommendation $recommendation)
    {
        $products = Product::all();
        $users = User::all();
        return view('sidebarcontent.recommendations.edit', compact('recommendation', 'products', 'users'));
    }

    public function update(Request $request, Recommendation $recommendation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'recommendation_type' => 'nullable|string|in:rule-based,ML-based',
        ]);

        $recommendation->update($request->all());

        return redirect()->route('recommendations.index')->with('success', 'Recommendation updated successfully.');
    }

    public function destroy(Recommendation $recommendation)
    {
        $recommendation->delete();

        return redirect()->route('recommendations.index')->with('success', 'Recommendation deleted successfully.');
    }
}