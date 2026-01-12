@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="row g-0">
                    
                    {{-- Bal oldal: Kép (csak nagyobb kijelzőn) --}}
                    <div class="col-lg-6 d-none d-lg-block position-relative">
                        <img src="{{ asset('images/kellekek.jpg') }}" 
                             alt="Regisztráció" 
                             class="w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                             style="filter: brightness(0.8);">
                        
                        {{-- Sötétítő réteg és szöveg --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-5" 
                             style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);">
                            <h3 class="text-white fw-bold mb-2">Csatlakozz hozzánk!</h3>
                            <p class="text-white-50 mb-0">Hozd létre saját fiókodat, és foglalj időpontot egyszerűen, online.</p>
                        </div>
                    </div>

                    {{-- Jobb oldal: Űrlap --}}
                    <div class="col-lg-6 p-5 bg-white">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-2 font-playfair text-dark">Regisztráció</h2>
                            <p class="text-muted small">Add meg adataidat a fiók létrehozásához.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Név --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" 
                                       id="name" name="name" placeholder="Teljes név" 
                                       value="{{ old('name') }}" required autofocus autocomplete="name">
                                <label for="name">Teljes név</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email cím --}}
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                                       id="email" name="email" placeholder="name@example.com" 
                                       value="{{ old('email') }}" required autocomplete="username">
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
                                       id="password" name="password" placeholder="Jelszó" required autocomplete="new-password">
                                <label for="password">Jelszó</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jelszó megerősítése --}}
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" placeholder="Jelszó megerősítése" required autocomplete="new-password">
                                <label for="password_confirmation">Jelszó megerősítése</label>
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Gomb --}}
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-dark btn-lg rounded-pill fw-bold text-uppercase py-3 shadow-sm hover-scale">
                                    Regisztráció
                                </button>
                            </div>

                            {{-- Bejelentkezés link --}}
                            <div class="text-center">
                                <p class="mb-0 text-muted small">Már van fiókod? 
                                    <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">
                                        Jelentkezz be itt
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

{{-- Extra CSS (Ugyanaz, mint a Login oldalon, hogy egységes legyen) --}}
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
    /* Bootstrap Floating Label fix */
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
</style>
@endsection