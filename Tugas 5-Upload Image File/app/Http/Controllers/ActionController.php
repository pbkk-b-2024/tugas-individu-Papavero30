<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Product;
use App\Models\User; 
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $actions = Action::with('user', 'actionable')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('action_type', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.actions.index', compact('actions'));
    }

    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('sidebarcontent.actions.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'action_type' => 'required|string|in:order,feedback,recommendation',
            'actionable_id' => 'required|integer',
            'actionable_type' => 'required|string',
        ]);

        Action::create($request->all());

        return redirect()->route('actions.index')->with('success', 'Action created successfully.');
    }

    public function edit(Action $action)
    {
        $products = Product::all();
        $users = User::all();
        return view('sidebarcontent.actions.edit', compact('action', 'products', 'users'));
    }

    public function update(Request $request, Action $action)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'action_type' => 'required|string|in:order,feedback,recommendation',
            'actionable_id' => 'required|integer',
            'actionable_type' => 'required|string',
        ]);

        $action->update($request->all());

        return redirect()->route('actions.index')->with('success', 'Action updated successfully.');
    }

    public function destroy(Action $action)
    {
        $action->delete();

        return redirect()->route('actions.index')->with('success', 'Action deleted successfully.');
    }
}