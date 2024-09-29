@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Inventory</h1>

    @can('update inventories')
        <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-select" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $inventory->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="ingredient" class="form-label">Ingredient</label>
                <input type="text" name="ingredient" id="ingredient" class="form-control" value="{{ $inventory->ingredient }}" required>
            </div>
            <div class="mb-3">
                <label for="quantity_available" class="form-label">Quantity Available</label>
                <input type="number" name="quantity_available" id="quantity_available" class="form-control" value="{{ $inventory->quantity_available }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Inventory</button>
        </form>
    @else
        <p>You do not have permission to update inventory.</p>
    @endcan
</div>
@endsection