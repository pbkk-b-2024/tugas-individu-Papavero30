@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Feedback</h1>

    @can('update feedback')
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

        <!-- Form to update an existing feedback record -->
        <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_id">Product:</label>
                <select name="product_id" class="form-control">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $feedback->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="order_id">Order:</label>
                <select name="order_id" class="form-control">
                    @foreach($orders as $order)
                        <option value="{{ $order->id }}" {{ $feedback->order_id == $order->id ? 'selected' : '' }}>
                            Order #{{ $order->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="rating">Rating (1-5):</label>
                <input type="number" class="form-control" name="rating" value="{{ $feedback->rating }}" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="comment">{{ $feedback->comment }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @else
        <p>You do not have permission to edit feedback.</p>
    @endcan
</div>
@endsection