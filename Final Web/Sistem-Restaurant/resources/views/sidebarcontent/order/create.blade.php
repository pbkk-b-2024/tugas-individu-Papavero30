@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Order</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to create a new order -->
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Customer:</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="number" step="0.01" class="form-control" name="total_price" required>
        </div>

        <div class="form-group">
            <label for="order_date">Order Date:</label>
            <input type="datetime-local" class="form-control" name="order_date" required>
        </div>

        <div class="form-group">
            <label for="order_type">Order Type:</label>
            <select name="order_type" class="form-control" required>
                <option value="Dine In">Dine In</option>
                <option value="Take Away">Take Away</option>
            </select>
        </div>

        <div class="form-group">
            <label for="products">Products:</label>
            @foreach($products as $product)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                    <label class="form-check-label">{{ $product->name }}</label>
                    <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control" placeholder="Quantity" min="1">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection