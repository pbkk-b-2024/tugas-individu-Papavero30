@extends('TemplateLayout')

@section('content')
<div class="container">
    <h1>Edit Supplier</h1>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
        </div>

        <div class="mb-3">
            <label for="contact_info" class="form-label">Contact Info</label>
            <textarea name="contact_info" class="form-control">{{ $supplier->contact_info }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection