<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('user', 'orderDetails.product')->paginate(5); 
        return view('sidebarcontent.order.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('sidebarcontent.order.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'order_type' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'order_date' => $request->order_date,
            'order_type' => $request->order_type,
        ]);

        foreach ($request->products as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function show($id)
    {
        $order = Order::with('user', 'orderDetails.product')->findOrFail($id);
        return view('sidebarcontent.order.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::with('orderDetails.product')->findOrFail($id);
        $users = User::all();
        $products = Product::all();
        return view('sidebarcontent.order.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'order_date' => 'required|date',
            'order_type' => 'required|string',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'order_date' => $request->order_date,
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

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}