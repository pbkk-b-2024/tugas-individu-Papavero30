<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderDetails.product')->paginate(5); 
        return view('sidebarcontent.order.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sidebarcontent.order.create', compact('products'));
    }

    public function store(Request $request)
{
    $request->validate([
        'order_type' => 'required|string',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    $total_price = 0;
    foreach ($request->products as $product) {
        $productModel = Product::findOrFail($product['id']);
        $total_price += $productModel->price * $product['quantity'];
    }

    $order = Order::create([
        'user_id' => Auth::id(),
        'total_price' => $total_price,
        'order_date' => now(), // Automatically set the order date
        'order_type' => $request->order_type,
    ]);

    foreach ($request->products as $product) {
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product['id'],
            'user_id' => Auth::id(),
            'quantity' => $product['quantity'],
            'price' => $product['quantity'] * $productModel->price,
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Order created successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'order_type' => 'required|string',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    $total_price = 0;
    foreach ($request->products as $product) {
        $productModel = Product::findOrFail($product['id']);
        $total_price += $productModel->price * $product['quantity'];
    }

    $order = Order::findOrFail($id);
    $order->update([
        'user_id' => Auth::id(),
        'total_price' => $total_price,
        'order_date' => now(), // Automatically set the order date
        'order_type' => $request->order_type,
    ]);

    $order->orderDetails()->delete();

    foreach ($request->products as $product) {
        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $product['id'],
            'quantity' => $product['quantity'],
        ]);
    }

    return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }
}