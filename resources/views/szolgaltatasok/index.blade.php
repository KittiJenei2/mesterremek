@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Szolgáltatások</h2>

    <div class="row">

        @foreach ($szolgaltatasok as $s)
            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">

                    <div class="card-body">
                        <h4 class="card-title">{{ $s->nev }}</h4>
                        <p class="card-text">{{ $s->leiras }}</p>

                        <p class="fw-bold mb-1">Ár: {{ $s->ar }} Ft</p>
                        <p class="text-muted mb-1">Időtartam: {{ $s->idotartam }} perc</p>
                        <p class="text-secondary">Kategória: {{ $s->kategoria->nev }}</p>
                    </div>
                </div>
            </div>
        @endforeach


    </div>
</div>
@endsection