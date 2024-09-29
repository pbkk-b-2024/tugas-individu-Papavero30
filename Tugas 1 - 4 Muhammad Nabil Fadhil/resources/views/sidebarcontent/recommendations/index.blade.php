@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Recommendations</h1>

    <!-- Display any success messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create recommendations')
        <!-- Button to create a new recommendation record -->
        <a href="{{ route('recommendations.create') }}" class="btn btn-primary mb-3">Add New Recommendation</a>
    @endcan

    <!-- Search Form -->
    <form action="{{ route('recommendations.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search recommendations" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Full height container for table and pagination -->
    <div style="height: calc(100vh - 200px); overflow-y: auto;">
        <!-- Display the recommendation records in a table with fixed column widths -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 25%;">Customer</th>
                    <th style="width: 25%;">Product</th>
                    <th style="width: 25%;">Recommendation Type</th>
                    <th style="width: 25%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recommendations as $recommendation)
                    <tr>
                        <td>{{ $recommendation->user->name }}</td>
                        <td>{{ $recommendation->product->name }}</td>
                        <td>{{ ucfirst($recommendation->recommendation_type) }}</td>
                        <td>
                            @can('update recommendations')
                                <!-- Edit Button -->
                                <a href="{{ route('recommendations.edit', $recommendation->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete recommendations')
                                <!-- Delete Button -->
                                <form action="{{ route('recommendations.destroy', $recommendation->id) }}" method="POST" style="display:inline;">
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

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $recommendations->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection