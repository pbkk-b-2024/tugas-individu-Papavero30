@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Actions</h1>

    <!-- Display any success messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Button to create a new action record -->
    @can('create actions')
        <a href="{{ route('actions.create') }}" class="btn btn-primary mb-3">Add New Action</a>
    @endcan

    <!-- Search Form -->
    <form action="{{ route('actions.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search actions" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Fixed height container for table and pagination -->
    <div style="height: 500px; overflow-y: auto;">
        <!-- Display the actions records in a table -->
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 25%;">User</th>
                    <th style="width: 25%;">Actionable</th>
                    <th style="width: 25%;">Action Type</th>
                    <th style="width: 25%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actions as $action)
                    <tr>
                        <td style="width: 25%;">{{ $action->user ? $action->user->name : 'N/A' }}</td>
                        <td style="width: 25%;">{{ $action->actionable ? class_basename($action->actionable) : 'N/A' }}</td>
                        <td style="width: 25%;">{{ ucfirst($action->action_type) }}</td>
                        <td style="width: 25%;">
                            <!-- Edit Button -->
                            @can('update actions')
                                <a href="{{ route('actions.edit', $action->id) }}" class="btn btn-warning">Edit</a>
                            @endcan

                            <!-- Delete Button -->
                            @can('delete actions')
                                <form action="{{ route('actions.destroy', $action->id) }}" method="POST" style="display:inline;">
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
        {{ $actions->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection