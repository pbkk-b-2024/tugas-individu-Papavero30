@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Inventory List</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create inventories')
        <a href="{{ route('inventory.create') }}" class="btn btn-primary mb-3">Add New Inventory</a>
    @endcan

    <!-- Search Form -->
    <form action="{{ route('inventory.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search inventory" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Fixed height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 20%;">Product</th>
                    <th style="width: 20%;">Ingredient</th>
                    <th style="width: 20%;">Quantity Available</th>
                    <th style="width: 20%;">Last Updated</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td style="width: 10%;">{{ $inventory->id }}</td>
                        <td style="width: 20%;">{{ $inventory->product->name }}</td>
                        <td style="width: 20%;">{{ $inventory->ingredient }}</td>
                        <td style="width: 20%;">{{ $inventory->quantity_available }}</td>
                        <td style="width: 20%;">{{ $inventory->updated_at }}</td>
                        <td style="width: 10%;">
                            @can('update inventories')
                                <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete inventories')
                                <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $inventories->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection