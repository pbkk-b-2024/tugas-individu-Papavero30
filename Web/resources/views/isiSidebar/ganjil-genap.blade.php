@extends('layout.layoutUmum')

@section('content')
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Cek Ganjil atau Genap</h5>
        </div>
        <div class="card-body">
            <form action="#" method="GET">
                @csrf
                <div class="mb-3">
                    <label for="number" class="form-label">Masukkan Angka</label>
                    <input type="number" class="form-control" id="number" name="number">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if(isset($result))
                <h5 class="mt-3">Hasil:</h5>
                <p>Angka {{ $number }} adalah <strong>{{ $result }}</strong></p>
            @endif
        </div>
    </div>
@endsection
