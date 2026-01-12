@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    
                    {{-- Bal oldal: Kép (csak nagyobb kijelzőn) --}}
                    <div class="col-lg-6 d-none d-lg-block position-relative">
                        <img src="{{ asset('images/csajos.jpg') }}" 
                             alt="Fresh Szalon" 
                             class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                             style="filter: brightness(0.9);">
                        
                        {{-- Sötétítő réteg és szöveg a képen --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-5" 
                             style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <h3 class="text-white fw-bold mb-2">Üdv újra nálunk!</h3>
                            <p class="text-white-50 mb-0">Jelentkezz be a fiókodba az időpontfoglaláshoz.</p>
                        </div>
                    </div>

                    {{-- Jobb oldal: Űrlap --}}
                    <div class="col-lg-6 p-5 bg-white">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-2 font-playfair text-dark">Bejelentkezés</h2>
                            <p class="text-muted small">Kérjük, add meg a belépési adataidat.</p>
                        </div>

                        {{-- Státusz üzenet (pl. jelszóvisszaállítás után) --}}
                        @if (session('status'))
                            <div class="alert alert-success mb-4 text-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{-- Email cím --}}
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                       id="email" name="email" placeholder="name@example.com" 
                                       value="{{ old('email') }}" required autofocus>
                                <label for="email">Email cím</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jelszó --}}
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Jelszó" required>
                                <label for="password">Jelszó</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Emlékezz rám és Elfelejtett jelszó --}}
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                    <label class="form-check-label small text-muted" for="remember_me">
                                        Emlékezz rám
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small text-primary fw-bold" href="{{ route('password.request') }}">
                                        Elfelejtett jelszó?
                                    </a>
                                @endif
                            </div>

                            {{-- Gomb --}}
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-dark btn-lg rounded-pill fw-bold text-uppercase py-3 shadow-sm hover-scale">
                                    Bejelentkezés
                                </button>
                            </div>

                            {{-- Regisztráció link --}}
                            <div class="text-center">
                                <p class="mb-0 text-muted small">Még nincs fiókod? 
                                    <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                                        Regisztrálj itt
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Extra CSS ehhez az oldalhoz --}}
<style>
    .font-playfair {
        font-family: 'Playfair Display', serif;
    }
    .hover-scale {
        transition: transform 0.2s;
    }
    .hover-scale:hover {
        transform: scale(1.02);
    }
    /* Bootstrap Floating Label fix, hogy szebb legyen a keret */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
</style>
@endsection