@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Products</h1>

    <!-- Display any success messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button to create a new product -->
    @can('create products')
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
    @endcan

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search products" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Grid Layout for Products -->
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <!-- Product Card -->
                <div class="product-card h-100">
                    <div class="position-relative">
                        <!-- Product Image -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="card-img-top product-image" style="height: 300px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300" alt="No Image" class="card-img-top product-image" style="height: 300px; object-fit: cover;">
                        @endif

                        <!-- Hover Buttons (Edit, Delete, Order) -->
                        <div class="product-hover-buttons">
                            @can('update products')
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan

                            @can('delete products')
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan

                            <!-- Order Button (Add to Cart) -->
                            <a href="{{ route('orders.index', $product->id) }}" class="btn btn-primary btn-sm">Pesan</a>
                        </div>
                    </div>

                    <!-- Product Details (Name, Description, Price) -->
                    <div class="product-details mt-2">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->description }}</p>
                        <p><strong>${{ $product->price }}</strong></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<!-- Custom Styles -->
<style>
    .product-card {
    position: relative;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.product-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image {
    width: 100%;
    height: auto;
}

.product-hover-buttons {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    justify-content: center;
    gap: 10px;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 10px;
}

.product-card:hover .product-hover-buttons {
    display: flex;
}

.product-hover-buttons .btn {
    padding: 5px 10px;
    font-size: 14px;
}

.product-details {
    padding: 10px;
    text-align: center;
}

.product-details h5 {
    margin: 10px 0 5px;
}

.product-details p {
    margin: 0;
}
</style>
@endsection