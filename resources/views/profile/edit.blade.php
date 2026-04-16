@extends('layouts.app')

@section('content')

{{-- Dekoratív háttér sáv (opcionális, feldobja az oldalt) --}}
<div class="bg-dark text-white py-5 mb-5 text-center shadow-sm">
    <h1 class="fw-bold text-uppercase display-5">Beállítások</h1>
    <p class="lead text-white-50">Személyes adatok és biztonsági beállítások kezelése</p>
</div>

<div class="container pb-5">

    {{-- Visszajelzések --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <strong>Siker!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        
        {{-- 1. KÁRTYA: Személyes adatok --}}
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-bottom-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                            <i class="fs-4">👤</i> 
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-dark">Személyes adatok</h4>
                            <small class="text-muted">Az itt megadott adatok jelennek meg a foglalásnál.</small>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4 pt-0">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        {{-- Név --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control bg-light border-0 shadow-sm" id="nev" name="nev" 
                                   value="{{ old('nev', $felhasznalo->nev) }}" placeholder="Név" required>
                            <label for="nev" class="text-muted">Teljes név</label>
                            @error('nev') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control bg-light border-0 shadow-sm" id="email" name="email" 
                                   value="{{ old('email', $felhasznalo->email) }}" placeholder="Email" required>
                            <label for="email" class="text-muted">Email cím</label>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Telefon --}}
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control bg-light border-0 shadow-sm" id="telefonszam" name="telefonszam" 
                                   value="{{ old('telefonszam', $felhasznalo->telefonszam) }}" placeholder="+36 30 123 4567">
                            <label for="telefonszam" class="text-muted">Telefonszám</label>
                            @error('telefonszam') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- ÚJ MEZŐ: Jelenlegi jelszó a megerősítéshez --}}
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" name="password_confirmation" placeholder="Jelenlegi jelszó" required>
                            <label for="password_confirmation" class="text-muted">Jelenlegi jelszó a mentéshez</label>
                            
                            {{-- Gomb a jelszóhoz (szem ikon) --}}
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="password_confirmation" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>

                            @error('password_confirmation') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3 rounded-pill fw-bold text-uppercase shadow-sm">
                                Adatok mentése
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 2. KÁRTYA: Jelszó módosítás --}}
        <div class="col-lg-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-bottom-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                            <i class="fs-4">🔒</i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-dark">Jelszó módosítása</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 pt-0">
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- 1. Jelenlegi jelszó --}}
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" placeholder="Jelenlegi jelszó" required>
                            <label for="current_password" class="text-muted">Jelenlegi jelszó</label>
                            
                            {{-- Gomb a jelenlegi jelszóhoz --}}
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="current_password" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>

                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="text-muted my-4 opacity-25">

                        {{-- 2. Új jelszó --}}
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Új jelszó" required>
                            <label for="password" class="text-muted">Új jelszó</label>
                            
                            {{-- Gomb az új jelszóhoz --}}
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="password" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ÚJ: JELSZÓERŐSSÉG MÉRŐ --}}
                        <div id="password-strength-container" style="display: none; margin-bottom: 1rem; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.85rem; color: #6c757d;">Jelszó erőssége:</span>
                                <span id="password-strength-text" style="font-size: 0.85rem; font-weight: bold; color: #dc3545;">Gyenge</span>
                            </div>
                            
                            {{-- A csík --}}
                            <div style="height: 6px; background-color: #e9ecef; border-radius: 10px; overflow: hidden;">
                                <div id="password-strength-bar" style="height: 100%; width: 0%; background-color: #dc3545; transition: width 0.4s ease, background-color 0.4s ease;"></div>
                            </div>

                            {{-- Szabályok --}}
                            <ul style="margin-top: 12px; margin-bottom: 0; padding-left: 0; list-style: none; font-size: 0.8rem; display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                                <li id="rule-length" style="color: #dc3545; transition: color 0.3s;">✖ Min. 8 karakter</li>
                                <li id="rule-lower" style="color: #dc3545; transition: color 0.3s;">✖ Kisbetű</li>
                                <li id="rule-upper" style="color: #dc3545; transition: color 0.3s;">✖ Nagybetű</li>
                                <li id="rule-number" style="color: #dc3545; transition: color 0.3s;">✖ Szám</li>
                            </ul>
                        </div>
                        {{-- JELSZÓERŐSSÉG MÉRŐ VÉGE --}}

                        {{-- 3. Megerősítés --}}
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm" 
                                   id="password_confirmation_jelszo" name="password_confirmation" placeholder="Új jelszó újra" required>
                            <label for="password_confirmation_jelszo" class="text-muted">Új jelszó megerősítése</label>
                            
                            {{-- Gomb a megerősítéshez --}}
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="password_confirmation_jelszo" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                            </button>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning py-3 rounded-pill fw-bold text-uppercase shadow-sm text-dark">
                                Jelszó megváltoztatása
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- Vissza gomb --}}
    <div class="text-center mt-5">
        <a href="{{ route('profile.index') }}" class="btn btn-link text-decoration-none text-muted fw-bold">
            ← Vissza a profilomhoz
        </a>
    </div>

</div>

@endsection