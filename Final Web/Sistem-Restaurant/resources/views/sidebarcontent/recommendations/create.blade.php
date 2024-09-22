@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Recommendation</h1>

    @can('create recommendations')
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

        <!-- Form to create a new recommendation record -->
        <form action="{{ route('recommendations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Customer:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="product_id">Product:</label>
                <select name="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="recommendation_type">Recommendation Type:</label>
                <select name="recommendation_type" class="form-control">
                    <option value="rule-based">Rule-Based</option>
                    <option value="ML-based">ML-Based</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <p>You do not have permission to create recommendations.</p>
    @endcan
</div>
@endsection