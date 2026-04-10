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
                                       id="telefonszam" name="telefonszam" placeholder="06301234567" 
                                       value="{{ old('telefonszam') }}" required>
                                <label for="telefonszam">Telefonszám (pl. 06301234567)</label>
                                @error('telefonszam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Jelszó --}}
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control rounded-3 @error('jelszo') is-invalid @enderror" 
                                       id="jelszo" name="jelszo" placeholder="Jelszó" required autocomplete="new-password">
                                <label for="jelszo">Jelszó</label>
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

{{-- Extra CSS --}}
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

{{-- ÚJ: JELSZÓERŐSSÉG JAVASCRIPT --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('jelszo'); 
    const container = document.getElementById('password-strength-container');
    const bar = document.getElementById('password-strength-bar');
    const text = document.getElementById('password-strength-text');
    
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number')
    };

    if (passwordInput && container) {
        passwordInput.addEventListener('input', function() {
            const val = passwordInput.value;
            
            if (val.length === 0) {
                container.style.display = 'none';
                return;
            } else {
                container.style.display = 'block';
            }

            let score = 0;

            if (val.length >= 8) { score++; updateRule(rules.length, true, '✔ Min. 8 karakter'); } 
            else { updateRule(rules.length, false, '✖ Min. 8 karakter'); }

            if (/[a-z]/.test(val)) { score++; updateRule(rules.lower, true, '✔ Kisbetű'); } 
            else { updateRule(rules.lower, false, '✖ Kisbetű'); }

            if (/[A-Z]/.test(val)) { score++; updateRule(rules.upper, true, '✔ Nagybetű'); } 
            else { updateRule(rules.upper, false, '✖ Nagybetű'); }

            if (/[0-9]/.test(val)) { score++; updateRule(rules.number, true, '✔ Szám'); } 
            else { updateRule(rules.number, false, '✖ Szám'); }

            if (/[^A-Za-z0-9]/.test(val) && val.length >= 8) { score++; }

            if (score <= 1) {
                bar.style.width = '25%';
                bar.style.backgroundColor = '#dc3545';
                text.textContent = 'Gyenge';
                text.style.color = '#dc3545';
            } else if (score === 2 || score === 3) {
                bar.style.width = '50%';
                bar.style.backgroundColor = '#ffc107';
                text.textContent = 'Közepes';
                text.style.color = '#d39e00';
            } else if (score === 4) {
                bar.style.width = '75%';
                bar.style.backgroundColor = '#0dcaf0';
                text.textContent = 'Jó';
                text.style.color = '#0dcaf0';
            } else if (score >= 5) {
                bar.style.width = '100%';
                bar.style.backgroundColor = '#198754';
                text.textContent = 'Erős';
                text.style.color = '#198754';
            }
        });
    }

    function updateRule(element, isMet, textStr) {
        element.textContent = textStr;
        element.style.color = isMet ? '#198754' : '#dc3545';
    }
});
</script>
@endsection
@endsection