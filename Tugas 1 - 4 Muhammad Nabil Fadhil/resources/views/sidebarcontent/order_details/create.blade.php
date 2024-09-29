@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Order Detail</h1>

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

    <!-- Form to create a new order detail -->
    <form action="{{ route('order_details.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="order_id">Order:</label>
            <select name="order_id" class="form-control">
                @foreach($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" min="1" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection