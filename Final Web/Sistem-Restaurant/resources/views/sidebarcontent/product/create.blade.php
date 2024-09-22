@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Product</h1>

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

    <!-- Form to create a new product -->
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->categories_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients:</label>
            <div id="ingredients-container">
                <input type="text" class="form-control mb-2" name="ingredients[]" placeholder="Ingredient 1">
            </div>
            <button type="button" class="btn btn-secondary" onclick="addIngredientField()">Add Ingredient</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
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