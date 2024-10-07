<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Resources\SupplierResource;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $suppliers = Supplier::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('contact_info', 'like', "%{$search}%");
            })->paginate(5);

        if ($request->expectsJson()) {
            return SupplierResource::collection($suppliers);
        }

        return view('sidebarcontent.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('sidebarcontent.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_info' => 'nullable',
        ]);

        $supplier = Supplier::create($request->all());

        if ($request->expectsJson()) {
            return new SupplierResource($supplier);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier, Request $request)
    {
        if ($request->expectsJson()) {
            return new SupplierResource($supplier);
        }

        return view('sidebarcontent.suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('sidebarcontent.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required',
            'contact_info' => 'nullable',
        ]);

        $supplier->update($request->all());

        if ($request->expectsJson()) {
            return new SupplierResource($supplier);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier, Request $request)
    {
        $supplier->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Supplier deleted successfully'], 200);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }
}