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
                                <input type="text" class="form-control rounded-3 @error('nev') is-invalid @enderror" 
                                       id="nev" name="nev" placeholder="Teljes név" 
                                       value="{{ old('nev') }}" required autofocus autocomplete="name">
                                <label for="nev">Teljes név</label>
                                @error('nev')
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

                            {{-- Telefonszám --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control rounded-3 @error('telefonszam') is-invalid @enderror" 
                                       id="telefonszam" name="telefonszam" placeholder="+36 30 123 4567" 
                                       value="{{ old('telefonszam') }}" required>
                                <label for="telefonszam">Telefonszám</label>
                                @error('telefonszam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jelszó --}}
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" class="form-control rounded-3 @error('jelszo') is-invalid @enderror" 
                                       id="jelszo" name="jelszo" placeholder="Jelszó" required autocomplete="new-password">
                                <label for="jelszo">Jelszó</label>
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="jelszo" style="z-index: 5;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                                @error('jelszo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- ÚJ: JELSZÓERŐSSÉG MÉRŐ --}}
                            <div id="password-strength-container" style="display: none; margin-bottom: 1rem; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="font-size: 0.85rem; color: #6c757d;">Jelszó erőssége:</span>
                                    <span id="password-strength-text" style="font-size: 0.85rem; font-weight: bold; color: #dc3545;">Gyenge</span>
                                </div>
                                
                                {{-- A csík maga --}}
                                <div style="height: 6px; background-color: #e9ecef; border-radius: 10px; overflow: hidden;">
                                    <div id="password-strength-bar" style="height: 100%; width: 0%; background-color: #dc3545; transition: width 0.4s ease, background-color 0.4s ease;"></div>
                                </div>

                                {{-- Követelmények listája --}}
                                <ul style="margin-top: 12px; margin-bottom: 0; padding-left: 0; list-style: none; font-size: 0.8rem; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                    <li id="rule-length" style="color: #dc3545; transition: color 0.3s;">✖ Min. 8 karakter</li>
                                    <li id="rule-lower" style="color: #dc3545; transition: color 0.3s;">✖ Kisbetű</li>
                                    <li id="rule-upper" style="color: #dc3545; transition: color 0.3s;">✖ Nagybetű</li>
                                    <li id="rule-number" style="color: #dc3545; transition: color 0.3s;">✖ Szám</li>
                                </ul>
                            </div>
                            {{-- JELSZÓERŐSSÉG MÉRŐ VÉGE --}}

                            {{-- Jelszó megerősítése --}}
                            <div class="form-floating mb-4 position-relative">
                                <input type="password" class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror" 
                                    id="password_confirmation" name="password_confirmation" placeholder="Jelszó megerősítése" required autocomplete="new-password">
                                <label for="password_confirmation">Jelszó megerősítése</label>
                                
                                {{-- JAVÍTVA: A data-target itt 'password_confirmation' kell legyen! --}}
                                <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="password_confirmation" style="z-index: 5;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                </button>
                                
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





@endsection