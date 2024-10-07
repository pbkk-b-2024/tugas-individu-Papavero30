@extends('TemplateLayout')

@section('content')
<div class="container-fluid">
    <h1>Feedback</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @can('create feedback')
        <a href="{{ route('feedback.create') }}" class="btn btn-primary mb-3">Add New Feedback</a>
    @endcan

    <form action="{{ route('feedback.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search feedback" value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div style="height: 500px; overflow-y: auto;">
        <table class="table table-bordered table-fixed">
            <thead>
                <tr>
                    <th style="width: 15%;">User</th>
                    <th style="width: 15%;">Product</th>
                    <th style="width: 10%;">Order</th>
                    <th style="width: 10%;">Rating</th>
                    <th style="width: 40%;">Comment</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedbacks as $feedback)
                    <tr>
                        <td style="width: 15%;">{{ $feedback->user->name }}</td>
                        <td style="width: 15%;">{{ $feedback->product->name }}</td>
                        <td style="width: 10%;">Order #{{ $feedback->order->id }}</td>
                        <td style="width: 10%;">{{ $feedback->rating }}</td>
                        <td style="width: 40%;">{{ $feedback->comment }}</td>
                        <td style="width: 10%;">
                            @can('update feedback')
                                <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete feedback')
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" style="display:inline;">
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
        {{ $feedbacks->appends(['search' => request()->query('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection