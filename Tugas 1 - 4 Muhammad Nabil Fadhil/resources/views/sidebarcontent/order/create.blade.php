@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Order</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

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
        
        <div class="form-group">
            <label for="order_type">Order Type:</label>
            <select name="order_type" class="form-control" required>
                <option value="Dine In">Dine In</option>
                <option value="Take Away">Take Away</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection