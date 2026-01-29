@extends('layouts.app')

@section('content')

{{-- 1. Hero Szekció (Kisebb, mint a főoldalon) --}}
<div class="position-relative mb-5">
    <div style="height: 300px; overflow: hidden;">
        <img src="{{ asset('images/fodraszkellek.jpg') }}" class="w-100 h-100" style="object-fit: cover; filter: brightness(0.6);" alt="Szolgáltatásaink">
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bold text-uppercase">Szolgáltatásaink</h1>
        <p class="lead">Válassz prémium kezeléseink közül</p>
    </div>
</div>

<div class="container">

    {{-- 2. Szolgáltatások listázása Kategóriák szerint --}}
    {{-- A controllerben lekért $szolgaltatasok változót itt csoportosítjuk a kategória neve alapján --}}
    @php
        $csoportositottSzolgaltatasok = $szolgaltatasok->groupBy(function($item) {
            return $item->kategoria ? $item->kategoria->nev : 'Egyéb szolgáltatások';
        });
    @endphp

    @foreach($csoportositottSzolgaltatasok as $kategoriaNev => $szolgaltatasokCsoport)
        
        {{-- Kategória Cím --}}
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0 me-3">{{ $kategoriaNev }}</h2>
                <div class="flex-grow-1 border-bottom"></div> {{-- Díszcsík --}}
            </div>

            <div class="row g-4">
                @foreach($szolgaltatasokCsoport as $szolgaltatas)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm service-card hover-elevate">
                            <div class="card-body p-4 d-flex flex-column">
                                
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h4 class="card-title fw-bold text-primary mb-0">
                                        {{ $szolgaltatas->nev }}
                                    </h4>
                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                        {{ $szolgaltatas->idotartam }} perc
                                    </span>
                                </div>

                                <p class="card-text text-muted mb-4 flex-grow-1">
                                    {{ $szolgaltatas->leiras ?? 'Ehhez a szolgáltatáshoz még nincs részletes leírás.' }}
                                </p>

                                <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                                    <div>
                                        <small class="text-muted text-uppercase d-block">Ár</small>
                                        <span class="fw-bold fs-5">{{ number_format($szolgaltatas->ar, 0, ',', ' ') }} Ft</span>
                                    </div>
                                    
                                    {{-- Gomb: átvisz az időpontfoglaláshoz és kiválasztja a szolgáltatást --}}
                                    {{-- Megjegyzés: A 'selected_service' paramétert később lekezelhetjük a foglalás oldalon --}}
                                    <a href="{{ route('idopontfoglalas.index', [
                                        'category_id' => $szolgaltatas->lehetosegek_id, 
                                        'service_id' => $szolgaltatas->id
                                        ]) }}" class="btn btn-outline-dark rounded-pill px-4">
                                        Foglalás
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    @if($szolgaltatasok->isEmpty())
        <div class="text-center py-5">
            <h3 class="text-muted">Jelenleg nincsenek elérhető szolgáltatások.</h3>
        </div>
    @endif

</div>

{{-- Egy kis extra CSS csak ehhez az oldalhoz --}}
<style>
    .hover-elevate {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-elevate:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>

@endsection