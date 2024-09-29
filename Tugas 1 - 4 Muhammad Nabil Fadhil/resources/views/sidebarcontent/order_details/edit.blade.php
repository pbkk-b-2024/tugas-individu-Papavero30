@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Order Detail</h1>

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

    <!-- Form to update an existing order detail -->
    <form action="{{ route('order_details.update', $orderDetail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="order_id">Order:</label>
            <select name="order_id" class="form-control">
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $orderDetail->order_id == $order->id ? 'selected' : '' }}>
                        {{ $order->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $orderDetail->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $orderDetail->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" value="{{ $orderDetail->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ $orderDetail->price }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection