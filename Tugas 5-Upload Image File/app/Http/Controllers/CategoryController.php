<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('categories_name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->paginate(5);

        if ($request->expectsJson()) {
            return CategoryResource::collection($categories);
        }

        return view('sidebarcontent.category.index', compact('categories'));
    }

    public function create()
    {
        return view('sidebarcontent.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = Category::create($request->all());

        if ($request->expectsJson()) {
            return new CategoryResource($category);
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category, Request $request)
    {
        if ($request->expectsJson()) {
            return new CategoryResource($category);
        }

        return view('sidebarcontent.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('sidebarcontent.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categories_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->update($request->all());

        if ($request->expectsJson()) {
            return new CategoryResource($category);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category, Request $request)
    {
        $category->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Category deleted successfully'], 200);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}