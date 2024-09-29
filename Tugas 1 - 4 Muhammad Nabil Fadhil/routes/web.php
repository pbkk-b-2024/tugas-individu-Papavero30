<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController, ProductController, OrderController, OrderDetailController,
    InventoryController, FeedbackController, ActionController, RecommendationController,
    SupplierProductController, SupplierController, DashboardController
};

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return response()->view('layout.fallback', [], 404);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['role:admin|customer'])->group(function () {
        Route::resource('categories', CategoryController::class)->middleware('permission:read categories|create categories|update categories|delete categories');
        Route::resource('suppliers', SupplierController::class)->middleware('permission:read suppliers|create suppliers|update suppliers|delete suppliers');
        Route::resource('products', ProductController::class)->middleware('permission:read products|create products|update products|delete products');
        Route::resource('orders', OrderController::class)->middleware('permission:read orders|create orders|update orders|delete orders');
        Route::resource('order_details', OrderDetailController::class)->middleware('permission:read order details|create order details|update order details|delete order details');
        Route::resource('inventory', InventoryController::class)->middleware('permission:read inventories|create inventories|update inventories|delete inventories');
        Route::resource('feedback', FeedbackController::class)->middleware('permission:read feedback|create feedback|update feedback|delete feedback');
        Route::resource('supplier_products', SupplierProductController::class)->middleware('permission:read supplier products|create supplier products|update supplier products|delete supplier products');
        Route::resource('recommendations', RecommendationController::class)->middleware('permission:read recommendations|create recommendations|update recommendations|delete recommendations');
        Route::resource('actions', ActionController::class)->middleware('permission:read actions|create actions|update actions|delete actions');
    });
});