@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Recommendation</h1>

    @can('update recommendations')
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

        <!-- Form to update an existing recommendation record -->
        <form action="{{ route('recommendations.update', $recommendation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">Customer:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $recommendation->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_id">Product:</label>
                <select name="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $recommendation->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="recommendation_type">Recommendation Type:</label>
                <select name="recommendation_type" class="form-control">
                    <option value="rule-based" {{ $recommendation->recommendation_type == 'rule-based' ? 'selected' : '' }}>Rule-Based</option>
                    <option value="ML-based" {{ $recommendation->recommendation_type == 'ML-based' ? 'selected' : '' }}>ML-Based</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @else
        <p>You do not have permission to edit recommendations.</p>
    @endcan
</div>
@endsection