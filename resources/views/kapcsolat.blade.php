@extends('layouts.app')

@section('content')

{{-- 1. Hero Szekció --}}
<div class="position-relative mb-5">
    <div style="height: 300px; overflow: hidden;">
        <img src="{{ asset('images/szalon.jpg') }}" class="w-100 h-100" style="object-fit: cover; filter: brightness(0.6);" alt="Kapcsolat">
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bold text-uppercase font-playfair">Lépj velünk kapcsolatba</h1>
        <p class="lead">Kérdésed van? Keress minket bizalommal!</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-5">
        
        {{-- 2. Bal oldal: Elérhetőségek --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-lg h-100 rounded-4 overflow-hidden">
                <div class="card-body p-4 p-lg-5 bg-dark text-white d-flex flex-column justify-content-center">
                    
                    <h3 class="fw-bold mb-4 font-playfair">Elérhetőségeink</h3>
                    <p class="text-white-50 mb-5">
                        Szalonunk a város szívében várja a szépülni vágyókat. Hívj minket, írj nekünk, vagy gyere be hozzánk személyesen!
                    </p>

                    <div class="d-flex align-items-start mb-4">
                        <div class="me-3 fs-4 text-primary">📍</div>
                        <div>
                            <h5 class="fw-bold mb-1">Címünk</h5>
                            <p class="mb-0 text-white-50">1052 Budapest, Szalon utca 1.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="me-3 fs-4 text-primary">📞</div>
                        <div>
                            <h5 class="fw-bold mb-1">Telefon</h5>
                            <p class="mb-0 text-white-50">+36 1 234 5678</p>
                            <small class="text-muted">Hétköznap 08:00 - 18:00</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="me-3 fs-4 text-primary">✉️</div>
                        <div>
                            <h5 class="fw-bold mb-1">Email</h5>
                            <p class="mb-0 text-white-50">info@freshszalon.hu</p>
                        </div>
                    </div>

                    <hr class="border-secondary my-4">

                    <h5 class="fw-bold mb-3">Nyitvatartás</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="d-flex justify-content-between mb-2">
                            <span>Hétfő - Péntek:</span>
                            <span class="text-white">09:00 - 20:00</span>
                        </li>
                        <li class="d-flex justify-content-between mb-2">
                            <span>Szombat:</span>
                            <span class="text-white">09:00 - 14:00</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span>Vasárnap:</span>
                            <span class="text-primary">Zárva</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        {{-- 3. Jobb oldal: Üzenetküldő űrlap --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 p-lg-5">
                    
                    <h3 class="fw-bold mb-2 font-playfair text-dark">Írj nekünk üzenetet</h3>
                    <p class="text-muted mb-4">Töltsd ki az űrlapot, és hamarosan válaszolunk.</p>

                    {{-- Sikerüzenet megjelenítése --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('kapcsolat.send') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Név" required>
                                    <label for="name">Teljes név</label>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                    <label for="email">Email cím</label>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-light border-0 @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Tárgy" required>
                                    <label for="subject">Üzenet tárgya</label>
                                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-light border-0 @error('message') is-invalid @enderror" name="message" id="message" placeholder="Üzenet" style="height: 150px" required>{{ old('message') }}</textarea>
                                    <label for="message">Miben segíthetünk?</label>
                                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-dark btn-lg rounded-pill px-5 py-3 w-100 fw-bold text-uppercase shadow-sm hover-scale">
                                    Üzenet elküldése
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    {{-- 4. Térkép (Google Maps Embed) --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2695.597651034336!2d19.04023531562678!3d47.49791297917737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dc41b8469653%3A0x6c003051e8a4a0!2sBudapest%2C%20De%C3%A1k%20Ferenc%20t%C3%A9r!5e0!3m2!1shu!2shu!4v1646841234567!5m2!1shu!2shu" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </div>

</div>

@endsection