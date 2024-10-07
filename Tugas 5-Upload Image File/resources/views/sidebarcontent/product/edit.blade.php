@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

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

    <!-- Form to update an existing product -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->categories_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <div id="ingredients-container">
                @foreach($product->ingredients as $index => $ingredient)
                    <input type="text" class="form-control mb-2" name="ingredients[]" value="{{ $ingredient }}" placeholder="Ingredient {{ $index + 1 }}">
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary" onclick="addIngredientField()">Add Ingredient</button>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="150">
                @else
                    No Image
                @endif
            </div>
            <input type="file" class="form-control" name="image" accept="image/jpeg,image/gif,image/png,application/pdf">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    function addIngredientField() {
        const container = document.getElementById('ingredients-container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'ingredients[]';
        input.className = 'form-control mb-2';
        input.placeholder = `Ingredient ${container.children.length + 1}`;
        container.appendChild(input);
    }
</script>
@endsection