@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create New Action</h1>

    @can('create actions')
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

        <!-- Form to create a new action record -->
        <form action="{{ route('actions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="actionable_id">Actionable ID:</label>
                <input type="number" name="actionable_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="actionable_type">Actionable Type:</label>
                <input type="text" name="actionable_type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="action_type">Action Type:</label>
                <select name="action_type" class="form-control">
                    <option value="order">Order</option>
                    <option value="feedback">Feedback</option>
                    <option value="recommendation">Recommendation</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <p>You do not have permission to create actions.</p>
    @endcan
</div>
@endsection