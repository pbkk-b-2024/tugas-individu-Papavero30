<?php

namespace App\Http\Controllers;

use App\Models\SupplierProduct;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Inventory;
use Illuminate\Http\Request;

class SupplierProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $supplierProducts = SupplierProduct::with('supplier', 'product')
            ->when($search, function ($query, $search) {
                return $query->whereHas('supplier', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('price', 'like', "%{$search}%")
                  ->orWhere('quantity', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.supplier_products.index', compact('supplierProducts'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $ingredients = Inventory::distinct()->pluck('ingredient');
        return view('sidebarcontent.supplier_products.create', compact('suppliers', 'products', 'ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'ingredient' => 'required|exists:inventories,ingredient',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        SupplierProduct::create($request->all());

        return redirect()->route('supplier_products.index')->with('success', 'Supplier product created successfully.');
    }

    public function edit(SupplierProduct $supplierProduct)
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $ingredients = Inventory::distinct()->pluck('ingredient');
        return view('sidebarcontent.supplier_products.edit', compact('supplierProduct', 'suppliers', 'products', 'ingredients'));
    }

    public function update(Request $request, SupplierProduct $supplierProduct)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'ingredient' => 'required|exists:inventories,ingredient',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $supplierProduct->update($request->all());

        return redirect()->route('supplier_products.index')->with('success', 'Supplier product updated successfully.');
    }

    public function destroy(SupplierProduct $supplierProduct)
    {
        $supplierProduct->delete();

        return redirect()->route('supplier_products.index')->with('success', 'Supplier product deleted successfully.');
    }
}