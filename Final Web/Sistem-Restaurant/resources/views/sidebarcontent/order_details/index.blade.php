@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Order Details</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create order details')
        <a href="{{ route('order_details.create') }}" class="btn btn-primary mb-3">Add New Order Detail</a>
    @endcan

    <form action="{{ route('order_details.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search order details" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 20%;">Order ID</th>
                    <th style="width: 20%;">Product</th>
                    <th style="width: 20%;">User</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 20%;">Price</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->order->id }}</td>
                        <td>{{ $orderDetail->product->name }}</td>
                        <td>{{ $orderDetail->user->name }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ $orderDetail->price }}</td>
                        <td>
                            @can('update order details')
                                <a href="{{ route('order_details.edit', $orderDetail->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete order details')
                                <form action="{{ route('order_details.destroy', $orderDetail->id) }}" method="POST" style="display:inline;">
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

    <div class="d-flex justify-content-center mt-3">
        {{ $orderDetails->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection