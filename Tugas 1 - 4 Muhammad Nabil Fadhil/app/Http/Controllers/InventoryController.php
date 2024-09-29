<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $inventories = Inventory::with('product')
            ->when($search, function ($query, $search) {
                return $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('quantity_available', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.inventory.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sidebarcontent.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_available' => 'required|integer|min:0',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventory.index')->with('success', 'Inventory record created successfully.');
    }

    public function edit(Inventory $inventory)
    {
        $products = Product::all();
        return view('sidebarcontent.inventory.edit', compact('inventory', 'products'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_available' => 'required|integer|min:0',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventory.index')->with('success', 'Inventory record updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory record deleted successfully.');
    }
}