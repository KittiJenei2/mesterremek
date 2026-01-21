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
                                   value="{{ old('telefonszam', $felhasznalo->telefonszam) }}" placeholder="Telefon">
                            <label for="telefonszam" class="text-muted">Telefonszám</label>
                            @error('telefonszam') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
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

                        {{-- Jelenlegi jelszó --}}
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" placeholder="Jelenlegi jelszó" required>
                            <label for="current_password" class="text-muted">Jelenlegi jelszó</label>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="text-muted my-4 opacity-25">

                        {{-- Új jelszó --}}
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Új jelszó" required>
                            <label for="password" class="text-muted">Új jelszó</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Megerősítés --}}
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control bg-light border-0 shadow-sm" 
                                   id="password_confirmation" name="password_confirmation" placeholder="Új jelszó újra" required>
                            <label for="password_confirmation" class="text-muted">Új jelszó megerősítése</label>
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