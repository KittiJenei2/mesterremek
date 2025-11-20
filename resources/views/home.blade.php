@extends('layouts.app')

@section('content')

<div class="container text-center mt-4">
    <h1 class="fw-bold">Üdvözlünk a Fresh szalon weboldalán!</h1>
    <p class="lead">Szépség, kényelem és elegancia egy helyen.</p>

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="{{ asset('images/kellekek.jpg') }}" class="d-block w-100" alt="Szalon beltér">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/fodraszkellek.jpg') }}" class="d-block w-100" alt="Szalon beltér">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('images/csajos.jpg') }}" class="d-block w-100" alt="Szalon beltér">
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

{{-- Ide jön majd a szolgáltatsáok+dolgozók rész --}}
<div class="container mt-5">
    <h2 class="text-center mb-4">Munkatársaink</h2>

    <div class="row">

        @foreach ($dolgozok as $dolgozo)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow">

                    <img src="{{ asset('images/dolgozok/' .$dolgozo->kep) }}" class="card-img-top" alt="{{ $dolgozo->nev }}">

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $dolgozo->nev }}</h5>
                        <p class="card-text">{{ $dolgozo->bio }}</p>

                        <a href="/idopontfoglalas" class="btn btn-primary">
                        Időpontfoglalás</a>
                    </div>

                </div>
            </div> 
        @endforeach
    </div>
</div>
    <h2>Rólunk</h2>
    <p>
        Szalonunk célja, hogy férfi és nő egy helyen, barátságos légkörben szépülhessen.
    </p>
</div>

@endsection