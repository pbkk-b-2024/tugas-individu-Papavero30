@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Categories</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <form action="{{ route('categories.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search categories" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 30%;">Category Name</th>
                    <th style="width: 50%;">Description</th>
                    <th style="width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td style="width: 30%;">{{ $category->categories_name }}</td>
                        <td style="width: 50%;">{{ $category->description }}</td>
                        <td style="width: 20%;">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $categories->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection