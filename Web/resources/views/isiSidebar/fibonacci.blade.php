@extends('layout.layoutUmum')

@section('content')
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Fibonacci Calculator</h5>
        </div>
        <div class="card-body">
            <form action="#" method="GET">
                @csrf
                <div class="mb-3">
                    <label for="n" class="form-label">Masukkan N</label>
                    <input type="number" class="form-control" id="n" name="n" aria-describedby="nHelp">
                    <div id="nHelp" class="form-text">Masukkan nilai N yang diinginkan</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @if(isset($result))
                <h5 class="mt-3">Hasil Perhitungan:</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Fibonacci</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
