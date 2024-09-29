@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Action</h1>

    @can('update actions')
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

        <!-- Form to update an existing action record -->
        <form action="{{ route('actions.update', $action->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $action->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="actionable_id">Actionable ID:</label>
                <input type="number" name="actionable_id" class="form-control" value="{{ $action->actionable_id }}" required>
            </div>

            <div class="form-group">
                <label for="actionable_type">Actionable Type:</label>
                <input type="text" name="actionable_type" class="form-control" value="{{ $action->actionable_type }}" required>
            </div>

            <div class="form-group">
                <label for="action_type">Action Type:</label>
                <select name="action_type" class="form-control">
                    <option value="order" {{ $action->action_type == 'order' ? 'selected' : '' }}>Order</option>
                    <option value="feedback" {{ $action->action_type == 'feedback' ? 'selected' : '' }}>Feedback</option>
                    <option value="recommendation" {{ $action->action_type == 'recommendation' ? 'selected' : '' }}>Recommendation</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    @else
        <p>You do not have permission to update actions.</p>
    @endcan
</div>
@endsection