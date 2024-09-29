@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Supplier Product</h1>

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

    <!-- Form to update an existing supplier product -->
    <form action="{{ route('supplier_products.update', $supplierProduct->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="supplier_id">Supplier:</label>
            <select name="supplier_id" class="form-control">
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ $supplierProduct->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_id">Product:</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $supplierProduct->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ingredient">Ingredient:</label>
            <select name="ingredient" class="form-control">
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient }}" {{ $supplierProduct->ingredient == $ingredient ? 'selected' : '' }}>
                        {{ $ingredient }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $supplierProduct->price }}">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" class="form-control" value="{{ $supplierProduct->quantity }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection