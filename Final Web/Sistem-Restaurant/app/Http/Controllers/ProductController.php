<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%")
                             ->orWhere('price', 'like', "%{$search}%")
                             ->orWhereHas('category', function ($q) use ($search) {
                                 $q->where('categories_name', 'like', "%{$search}%");
                             });
            })->paginate(5);

        return view('sidebarcontent.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('sidebarcontent.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|array', // Validate ingredients
        ]);
    
        $product = Product::create($request->all());
    
        // Automatically add ingredients to inventory
        foreach ($request->ingredients as $ingredient) {
            Inventory::create([
                'product_id' => $product->id,
                'ingredient' => $ingredient,
                'quantity_available' => 0,
            ]);
        }
    
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|array', // Validate ingredients
        ]);
    
        $product->update($request->all());
    
        // Update ingredients in inventory
        Inventory::where('product_id', $product->id)->delete();
        foreach ($request->ingredients as $ingredient) {
            Inventory::create([
                'product_id' => $product->id,
                'ingredient' => $ingredient,
                'quantity_available' => 0,
            ]);
        }
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}