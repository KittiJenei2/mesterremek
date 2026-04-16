@extends('layouts.app')

@section('content')

{{-- Hero Szekció --}}
<div class="position-relative mb-5">
    <div style="height: 300px; overflow: hidden; background-color: #333;">
        <img src="{{ asset('images/kellekek.jpg') }}" class="w-100 h-100" style="object-fit: cover; filter: brightness(0.6);" alt="Termékeink">
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bold text-uppercase">Termékeink</h1>
        <p class="lead">Vidd haza a szalon minőséget!</p>
    </div>
</div>

<div class="container pb-5">

    <div class="row mb-5">
        <div class="col-12 text-center">
            <p class="text-muted fs-5">Ezeket a professzionális termékeket személyesen a szalonunkban tudod megvásárolni. Keresd munkatársainkat!</p>
        </div>
    </div>

    {{-- KERESÉS ÉS SZŰRÉS --}}
    <div class="card border-0 shadow-sm rounded-4 mb-5 bg-light">
        <div class="card-body p-4">
            <form action="{{ route('termekek.index') }}" method="GET" class="row g-3 align-items-end" id="szuroForm">
                
                <div class="col-md-5">
                    <label for="kereses" class="form-label fw-bold text-muted small text-uppercase">Keresés név alapján</label>
                    <div class="input-group input-group-lg shadow-sm">
                        <span class="input-group-text bg-white border-0"><i class="text-primary">🔍</i></span>
                        <input type="text" name="kereses" id="kereses" class="form-control border-0" 
                               placeholder="Pl. Hajlakk, Arckrém..." 
                               value="{{ request('kereses') }}" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="kategoria" class="form-label fw-bold text-muted small text-uppercase">Kategória</label>
                    <select name="kategoria" id="kategoria" class="form-select form-select-lg border-0 shadow-sm">
                        <option value="">-- Minden kategória --</option>
                        @foreach($kategoriak as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategoria') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nev }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2" id="szuroGombok">
                    <button type="submit" class="btn btn-dark btn-lg w-100 rounded-pill shadow-sm">Szűrés</button>
                    @if(request()->filled('kereses') || request()->filled('kategoria'))
                        <a href="{{ route('termekek.index') }}" class="btn btn-outline-danger btn-lg rounded-pill px-3 reset-btn" title="Szűrők törlése">✖</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- TALÁLATOK KONTÉNER --}}
    <div id="talalatokContainer" style="transition: opacity 0.3s ease;">
        @php
            $csoportositottTermekek = $termekek->groupBy(function($item) {
                return $item->lehetoseg ? $item->lehetoseg->nev : 'Egyéb termékek';
            });
        @endphp

        @foreach($csoportositottTermekek as $kategoriaNev => $termekekCsoport)
            <div class="mb-5">
                <div class="d-flex align-items-center mb-4">
                    <h2 class="fw-bold text-dark mb-0 me-3">{{ $kategoriaNev }}</h2>
                    <div class="flex-grow-1 border-bottom"></div>
                </div>

                <div class="row g-4">
                    @foreach($termekekCsoport as $termek)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm product-card hover-elevate">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="mb-3">
                                        <span class="badge bg-dark text-white rounded-pill px-3 py-2 mb-2">Otthoni ápolás</span>
                                        <h4 class="card-title fw-bold text-primary mb-0">{{ $termek->nev }}</h4>
                                    </div>
                                    <p class="card-text text-muted mb-4 flex-grow-1">
                                        {{ $termek->leiras ?? 'Ehhez a termékhez még nincs részletes leírás.' }}
                                    </p>
                                    <div class="mt-auto d-flex align-items-center justify-content-between border-top pt-3">
                                        <div>
                                            <small class="text-muted text-uppercase d-block">Ár</small>
                                            <span class="fw-bold fs-4">{{ number_format($termek->ar, 0, ',', ' ') }} Ft</span>
                                        </div>
                                        <div class="text-success fw-bold small">
                                            <i class="fs-5">🛍️</i> Szalonban elérhető
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($termekek->isEmpty())
            <div class="alert alert-warning text-center p-5 rounded-4 shadow-sm mb-5">
                <h4 class="fw-bold mb-3">Sajnos nincs találat! 😔</h4>
                <p class="mb-0 fs-5">A megadott feltételekkel nem találtunk terméket.</p>
                @if(request()->filled('kereses') || request()->filled('kategoria'))
                    <a href="{{ route('termekek.index') }}" class="btn btn-outline-dark rounded-pill px-4 mt-4 reset-btn">
                        Keresés törlése és összes mutatása
                    </a>
                @endif
            </div>
        @endif
    </div>

</div>





@endsection