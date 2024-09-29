@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Supplier Products</h1>

    <!-- Display success messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button to create a new supplier product -->
    @can('create supplier products')
        <a href="{{ route('supplier_products.create') }}" class="btn btn-primary mb-3">Add New Supplier Product</a>
    @endcan

    <!-- Search Form -->
    <form action="{{ route('supplier_products.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search supplier products" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Full height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <!-- Display the supplier products in a table with fixed column widths -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 16%;">Supplier</th>
                    <th style="width: 16%;">Product</th>
                    <th style="width: 16%;">Ingredient</th>
                    <th style="width: 16%;">Price</th>
                    <th style="width: 16%;">Quantity</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supplierProducts as $supplierProduct)
                    <tr>
                        <td>{{ $supplierProduct->supplier->name }}</td>
                        <td>{{ $supplierProduct->product->name }}</td>
                        <td>{{ $supplierProduct->ingredient }}</td>
                        <td>{{ $supplierProduct->price }}</td>
                        <td>{{ $supplierProduct->quantity }}</td>
                        <td>
                            @can('update supplier products')
                                <!-- Edit Button -->
                                <a href="{{ route('supplier_products.edit', $supplierProduct->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete supplier products')
                                <!-- Delete Button -->
                                <form action="{{ route('supplier_products.destroy', $supplierProduct->id) }}" method="POST" style="display:inline;">
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
        {{ $supplierProducts->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection