@extends('layout.layoutUmum')

@section('content')
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Hasil URL</h5>
        </div>
        <div class="card-body">
            <p>Alamat URL yang Anda submit:</p>
            <p><strong>{{ $url }}</strong></p>
        </div>
    </div>
@endsection
