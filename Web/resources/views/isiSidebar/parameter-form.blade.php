@extends('layout.layoutUmum')

@section('content')
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Parameter Form</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('Pertemuan1.handle-single-parameter') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="param1" class="form-label">Masukkan Parameter 1</label>
                    <input type="text" class="form-control" id="param1" name="param1">
                </div>
                <button type="submit" class="btn btn-primary">Submit 1 Parameter</button>
            </form>

            <form action="{{ route('Pertemuan1.handle-double-parameter') }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="param1" class="form-label">Masukkan Parameter 1</label>
                    <input type="text" class="form-control" id="param1" name="param1">
                </div>
                <div class="mb-3">
                    <label for="param2" class="form-label">Masukkan Parameter 2</label>
                    <input type="text" class="form-control" id="param2" name="param2">
                </div>
                <button type="submit" class="btn btn-primary">Submit 2 Parameters</button>
            </form>
        </div>
    </div>
@endsection
