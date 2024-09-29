@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Add New Inventory</h1>

    @can('create inventories')
        <form action="{{ route('inventory.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="ingredient" class="form-label">Ingredient</label>
                <input type="text" name="ingredient" id="ingredient" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quantity_available" class="form-label">Quantity Available</label>
                <input type="number" name="quantity_available" id="quantity_available" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Inventory</button>
        </form>
    @else
        <p>You do not have permission to add inventory.</p>
    @endcan
</div>
@endsection