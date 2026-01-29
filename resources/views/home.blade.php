@extends('layouts.app')

@section('content')

{{-- Hero Szekció (Slider) --}}
<div class="container-fluid p-0 mb-5">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        
        {{-- Indikátorok (pöttyök alul) --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">

            {{-- 1. Slide --}}
            <div class="carousel-item active hero-slide">
                <img src="{{ asset('images/kellekek.jpg') }}" class="d-block w-100 hero-img" alt="Szalon beltér">
                <div class="hero-overlay"></div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="display-3 fw-bold text-uppercase mb-3 animate-fade-up">Fresh Szalon</h1>
                    <p class="lead mb-4 animate-fade-up delay-100">Szépség, kényelem és elegancia egy helyen.</p>
                    <a href="{{ route('idopontfoglalas.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-0 animate-fade-up delay-200">
                        Időpontfoglalás
                    </a>
                </div>
            </div>

            {{-- 2. Slide --}}
            <div class="carousel-item hero-slide">
                <img src="{{ asset('images/fodraszkellek.jpg') }}" class="d-block w-100 hero-img" alt="Fodrászkellékek">
                <div class="hero-overlay"></div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="display-3 fw-bold text-uppercase mb-3">Professzionális Eszközök</h1>
                    <p class="lead mb-4">Csak a legjobb minőségű anyagokkal dolgozunk.</p>
                    <a href="{{ route('szolgaltatasok.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-0">
                        Szolgáltatásaink
                    </a>
                </div>
            </div>

            {{-- 3. Slide --}}
            <div class="carousel-item hero-slide">
                <img src="{{ asset('images/csajos.jpg') }}" class="d-block w-100 hero-img" alt="Elégedett vendég">
                <div class="hero-overlay"></div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center h-100">
                    <h1 class="display-3 fw-bold text-uppercase mb-3">Megújulás Élménye</h1>
                    <p class="lead mb-4">Lépj be hozzánk és hagyd kint a külvilágot.</p>
                    <a href="{{ route('idopontfoglalas.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-0">
                        Foglalj most
                    </a>
                </div>
            </div>

        </div>

        {{-- Navigációs nyilak --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Előző</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Következő</span>
        </button>
    </div>
</div>

{{-- Ide jön majd a szolgáltatsáok+dolgozók rész --}}
{{-- Munkatársak szekció --}}
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase display-6">Ismerd meg csapatunkat!</h2>
        <p class="text-muted">Profi szakembereink szeretettel várnak időpontodra!</p>
    </div>

    <div class="row g-4 justify-content-center">
        @foreach ($dolgozok as $dolgozo)
            <div class="col-md-4 col-sm-6">
                {{-- Hozzáadtuk a 'dolgozo-card' osztályt --}}
                <div class="card h-100 border-0 shadow-sm text-center overflow-hidden dolgozo-card">
                    <div style="height: 300px; overflow: hidden;">
                        <img src="{{ asset('images/dolgozok/' .$dolgozo->kep) }}" class="w-100 h-100 object-fit-cover" alt="{{ $dolgozo->nev }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dolgozo->nev) }}&size=300';">
                    </div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-1">{{ $dolgozo->nev }}</h5>
                        <p class="mb-1">{{ $dolgozo->bio }}</p>
                    </div>
                </div>
            </div> 
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('dolgozok.index') }}" class="btn btn-dark btn-lg rounded-pill px-5 fw-bold shadow hover-scale">
            Összes kollégánk megtekintése
        </a>
    </div>
</div>

{{-- Rólunk szekció --}}
<div class="container py-5 mt-5 border-top">
    <div class="row align-items-center">
        
        {{-- Bal oldal: Kép --}}
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="position-relative">
                <img src="{{ asset('images/szalon.jpg') }}" 
                     alt="Szalonunk belseje" 
                     class="img-fluid rounded shadow w-100"
                     style="object-fit: cover; height: 400px;">
            </div>
        </div>

        {{-- Jobb oldal: Szöveg --}}
        <div class="col-lg-6 ps-lg-5">
            <span class="text-uppercase text-muted fw-bold small">Ismerj meg minket</span>
            <h2 class="fw-bold mb-4 mt-2">Rólunk</h2>
            
            <p class="lead text-dark">
                Szalonunk célja, hogy férfi és nő egy helyen, barátságos légkörben szépülhessen.
            </p>
            
            <p class="text-secondary mb-4">
                Hiszünk abban, hogy a szépségápolás nem csupán egy szolgáltatás, hanem élmény. 
                Professzionális csapatunk a legújabb trendekkel és technikákkal, prémium anyagokkal várja vendégeinket, 
                hogy a legjobbat hozzuk ki megjelenéséből.
            </p>

            <div class="row mb-4">
                <div class="col-6">
                    <h4 class="fw-bold text-primary">5+</h4>
                    <small class="text-muted">Év tapasztalat</small>
                </div>
                <div class="col-6">
                    <h4 class="fw-bold text-primary">1000+</h4>
                    <small class="text-muted">Elégedett vendég</small>
                </div>
            </div>

            <a href="/kapcsolat" class="btn btn-dark px-4 py-2">
                Kapcsolatfelvétel
            </a>
        </div>

    </div>
</div>

@endsection