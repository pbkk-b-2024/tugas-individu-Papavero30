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

    <!-- Full height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <!-- Display the products in a table with fixed column widths -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 20%;">Name</th>
                    <th style="width: 30%;">Description</th>
                    <th style="width: 15%;">Price</th>
                    <th style="width: 20%;">Category</th>
                    <th style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->categories_name }}</td>
                        <td>
                            <!-- Edit Button -->
                            @can('update products')
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            @endcan

                            <!-- Delete Button -->
                            @can('delete products')
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $products->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection