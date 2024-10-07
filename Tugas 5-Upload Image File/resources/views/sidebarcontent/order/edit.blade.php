@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Order</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="number" step="0.01" class="form-control" name="total_price" value="{{ $order->total_price }}" required>
        </div>

        <div class="form-group">
            <label for="order_type">Order Type:</label>
            <select name="order_type" class="form-control" required>
                <option value="Dine In" {{ $order->order_type == 'Dine In' ? 'selected' : '' }}>Dine In</option>
                <option value="Take Away" {{ $order->order_type == 'Take Away' ? 'selected' : '' }}>Take Away</option>
            </select>
        </div>

        <div class="form-group">
            <label for="products">Products:</label>
            @foreach($products as $product)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="products[{{ $product->id }}][id]" value="{{ $product->id }}" {{ in_array($product->id, $order->orderDetails->pluck('product_id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $product->name }}</label>
                    <input type="number" name="products[{{ $product->id }}][quantity]" class="form-control" placeholder="Quantity" min="1" value="{{ $order->orderDetails->where('product_id', $product->id)->first()->quantity ?? '' }}">
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection