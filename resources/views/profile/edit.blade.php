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
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('current_password') is-invalid @enderror" 
                                   id="current_password" name="current_password" placeholder="Jelenlegi jelszó" required>
                            <label for="current_password" class="text-muted">Jelenlegi jelszó</label>
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="jelszo" style="z-index: 5;">
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

                        {{-- Új jelszó --}}
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Új jelszó" required>
                            <label for="password" class="text-muted">Új jelszó</label>
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="jelszo" style="z-index: 5;">
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

                        {{-- Megerősítés --}}
                        <div class="form-floating mb-4 position-relative">
                            <input type="password" class="form-control bg-light border-0 shadow-sm" 
                                   id="password_confirmation" name="password_confirmation" placeholder="Új jelszó újra" required>
                            <label for="password_confirmation" class="text-muted">Új jelszó megerősítése</label>
                            <button type="button" class="btn border-0 position-absolute top-50 end-0 translate-middle-y me-2 text-muted toggle-password" data-target="jelszo" style="z-index: 5;">
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

{{-- ÚJ: JELSZÓERŐSSÉG JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ITT VAN A JAVÍTÁS: A te inputod ID-ja 'password', nem 'update_password_password'
    const passwordInput = document.getElementById('password'); 
    const container = document.getElementById('password-strength-container');
    const bar = document.getElementById('password-strength-bar');
    const text = document.getElementById('password-strength-text');
    
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number')
    };

    if (passwordInput) {
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password');
    
    // A két SVG ikon (nyitott és csukott szem)
    const eyeIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>`;
    const eyeSlashIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16"><path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.508.509z"/><path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/></svg>`;

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const inputField = document.getElementById(targetId);
            
            if (inputField.type === 'password') {
                inputField.type = 'text';
                this.innerHTML = eyeSlashIcon;
                this.classList.replace('text-muted', 'text-primary');
            } else {
                inputField.type = 'password';
                this.innerHTML = eyeIcon;
                this.classList.replace('text-primary', 'text-muted');
            }
        });
    });
});
</script>



<script>
// Továbbfejlesztett, intelligens telefonszám formázó (+36 formátum)
document.addEventListener('DOMContentLoaded', function () {
    const phoneInputs = document.querySelectorAll('input[name="telefonszam"]');

    phoneInputs.forEach(input => {
        input.addEventListener('input', function (e) {
            // Ha a felhasználó épp töröl (Backspace), nem avatkozunk be
            if (e.inputType === 'deleteContentBackward') return;

            let numbers = this.value.replace(/\D/g, ''); // Csak a számokat tartjuk meg

            // Ha teljesen kiürítette a mezőt
            if (numbers.length === 0) {
                this.value = '';
                return;
            }

            // 1. ZSENIÁLIS UX: Ha '06'-tal kezdődik, cseréljük '36'-ra a háttérben
            if (numbers.startsWith('06')) {
                numbers = '36' + numbers.substring(2);
            }

            // 2. Ha épp csak egy '0'-t írt be, hagyjuk a képernyőn, hogy be tudja írni a 6-ost
            if (numbers === '0') {
                this.value = '0';
                return;
            }

            // 3. Ha 20, 30, 70, 1 stb. van beírva (nem 36-tal és nem 0-val kezdődik), elérakjuk a 36-ot
            if (numbers.length >= 2 && !numbers.startsWith('36') && !numbers.startsWith('0')) {
                numbers = '36' + numbers;
            }

            let res = '';
            
            // Ha '36'-tal kezdődik (ami most már szinte biztos)
            if (numbers.startsWith('36')) {
                res = '+' + numbers.substring(0, 2); // +36
                
                if (numbers.length > 2) {
                    let isBp = numbers.charAt(2) === '1'; // Budapesti körzetszám (1)
                    let areaLength = isBp ? 1 : 2; // Körzetszám hossza (Bp: 1, Vidék/Mobil: 2)
                    
                    res += ' ' + numbers.substring(2, 2 + areaLength); // Körzetszám szóközökkel
                    
                    if (numbers.length > 2 + areaLength) {
                        res += ' ' + numbers.substring(2 + areaLength, 5 + areaLength); // Első 3 szám
                    }
                    if (numbers.length > 5 + areaLength) {
                        res += ' ' + numbers.substring(5 + areaLength, 9 + areaLength); // Utolsó 4 szám
                    }
                }
                this.value = res;
            } else if (numbers === '3') {
                // Ha épp csak a +36 elejét (a 3-ast) gépelte be
                this.value = '+' + numbers;
            } else {
                // Minden egyéb esetben (biztonsági ág)
                this.value = '+' + numbers;
            }
        });
    });
});
</script>

@endsection