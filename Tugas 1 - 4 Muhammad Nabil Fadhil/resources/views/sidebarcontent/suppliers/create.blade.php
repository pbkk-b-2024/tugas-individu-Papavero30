@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Create Supplier</h1>

    <form action="{{ route('suppliers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <textarea name="contact_info" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection