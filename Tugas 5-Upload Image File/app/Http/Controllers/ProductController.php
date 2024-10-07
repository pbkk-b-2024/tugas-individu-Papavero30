<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

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

        if ($request->expectsJson()) {
            return ProductResource::collection($products);
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->all();

        if ($request->hasFile('image')) {
            $productData['image'] = $request->file('image')->store('images', 'public');
        }

        $product = Product::create($productData);

        // Automatically add ingredients to inventory
        foreach ($request->ingredients as $ingredient) {
            Inventory::create([
                'product_id' => $product->id,
                'ingredient' => $ingredient,
                'quantity_available' => 0,
            ]);
        }

        if ($request->expectsJson()) {
            return new ProductResource($product);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product, Request $request)
    {
        if ($request->expectsJson()) {
            return new ProductResource($product);
        }

        return view('sidebarcontent.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('sidebarcontent.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'required|array', // Validate ingredients
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $productData['image'] = $request->file('image')->store('images', 'public');
        }

        $product->update($productData);

        // Update ingredients in inventory
        Inventory::where('product_id', $product->id)->delete();
        foreach ($request->ingredients as $ingredient) {
            Inventory::create([
                'product_id' => $product->id,
                'ingredient' => $ingredient,
                'quantity_available' => 0,
            ]);
        }

        if ($request->expectsJson()) {
            return new ProductResource($product);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product, Request $request)
    {
        $product->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function updateImage(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->image = $request->file('image')->store('images', 'public');
        $product->save();

        return redirect()->route('products.edit', $product->id)->with('success', 'Product image updated successfully.');
    }
}