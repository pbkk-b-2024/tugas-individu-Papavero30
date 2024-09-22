<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $orderDetails = OrderDetail::with(['order', 'product', 'user']) // Include user relationship
            ->when($search, function ($query, $search) {
                return $query->whereHas('order', function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%");
                })->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('user', function ($q) use ($search) { // Add user search
                    $q->where('name', 'like', "%{$search}%");
                })->orWhere('quantity', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");
            })->paginate(5);

        return view('sidebarcontent.order_details.index', compact('orderDetails'));
    }

    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        $users = User::all(); // Fetch users
        return view('sidebarcontent.order_details.create', compact('orders', 'products', 'users')); // Pass users to view
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id', // Validate user_id
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if the order detail already exists for the same user and product
        $orderDetail = OrderDetail::where('user_id', $request->user_id)
                                  ->where('product_id', $request->product_id)
                                  ->first();

        if ($orderDetail) {
            // Update the existing order detail
            $orderDetail->quantity += $request->quantity;
            $orderDetail->save();
        } else {
            // Create a new order detail
            OrderDetail::create($request->all());
        }

        return redirect()->route('order_details.index')->with('success', 'Order detail created successfully.');
    }

    public function edit(OrderDetail $orderDetail)
    {
        $orders = Order::all();
        $products = Product::all();
        $users = User::all(); // Fetch users
        return view('sidebarcontent.order_details.edit', compact('orderDetail', 'orders', 'products', 'users')); // Pass users to view
    }

    public function update(Request $request, OrderDetail $orderDetail)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id', 
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderDetail->update($request->all());

        return redirect()->route('order_details.index')->with('success', 'Order detail updated successfully.');
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();

        return redirect()->route('order_details.index')->with('success', 'Order detail deleted successfully.');
    }
}