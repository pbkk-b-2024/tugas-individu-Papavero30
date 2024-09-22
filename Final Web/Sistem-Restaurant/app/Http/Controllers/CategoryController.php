<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('categories_name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->paginate(5);

        return view('sidebarcontent.category.index', compact('categories'));
    }

    public function create()
    {
        return view('sidebarcontent.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories_name' => 'required',
            'description' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('sidebarcontent.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'categories_name' => 'required',
            'description' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}