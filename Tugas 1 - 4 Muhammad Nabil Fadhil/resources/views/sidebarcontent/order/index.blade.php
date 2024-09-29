@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Order List</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @can('create orders')
        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Add New Order</a>
    @endcan

    <form action="{{ route('orders.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search orders" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Customer</th>
                    <th style="width: 20%;">Total Price</th>
                    <th style="width: 20%;">Order Date</th>
                    <th style="width: 20%;">Order Type</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->order_type }}</td>
                        <td>
                            @can('update orders')
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete orders')
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
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
        {{ $orders->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection