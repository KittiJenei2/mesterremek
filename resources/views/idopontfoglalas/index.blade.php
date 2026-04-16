@extends('layouts.app')

@section('content')

{{-- 1. Hero Szekció --}}
<div class="position-relative mb-5">
    <div style="height: 250px; overflow: hidden;">
        <img src="{{ asset('images/kellekek.jpg') }}" class="w-100 h-100" style="object-fit: cover; filter: brightness(0.6);" alt="Időpontfoglalás">
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bold text-uppercase">Időpontfoglalás</h1>
        <p class="lead">Foglalj helyet kényelmesen, online!</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-dark text-white p-4 text-center">
                    <h4 class="mb-0 fw-light">Töltsd ki az adatokat a foglaláshoz</h4>
                </div>
                
                <div class="card-body p-4 p-lg-5">

                    {{-- Visszajelzés (Hiba esetén ezt még használjuk) --}}
                    <div id="alertMessage" class="d-none alert" role="alert"></div>

                    {{-- Jogosultság ellenőrzése --}}
                    @if(Auth::check() && Auth::user()->foglalhat == 0)
                        
                        <div class="alert alert-danger text-center p-4 rounded-3 shadow-sm mb-0 border-0">
                            <h4 class="fw-bold mb-3"><span class="text-danger fs-1 d-block mb-2">⚠️</span>Figyelem!</h4>
                            <p class="mb-0 fs-5">Fiókodhoz az időpontfoglalás funkció jelenleg <strong>le van tiltva</strong>.</p>
                            <p class="text-muted mt-2 small">Kérjük, vedd fel a kapcsolatot a szalonnal a további részletekért!</p>
                        </div>
                        
                    @else
                    <form id="bookingForm">
                        @csrf

                        {{-- 1. Kategória kiválasztása --}}
                        <div class="mb-4">
                            <label for="lehetoseg_id" class="form-label fw-bold text-uppercase text-muted small">1. Válassz kategóriát</label>
                            <select class="form-select form-select-lg shadow-sm border-0 bg-light" id="lehetoseg_id" name="lehetoseg_id" required>
                                <option value="" selected disabled>-- Kérjük válassz --</option>
                                @foreach ($lehetosegek as $lehetoseg)
                                    <option value="{{ $lehetoseg->id }}">{{ $lehetoseg->nev }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- 2. Szolgáltatás kiválasztása --}}
                        <div class="mb-4 d-none" id="step_szolgaltatas">
                            <label for="szolgaltatas_id" class="form-label fw-bold text-uppercase text-muted small">2. Válassz szolgáltatást</label>
                            <div class="position-relative">
                                <select class="form-select form-select-lg shadow-sm border-0 bg-light" id="szolgaltatas_id" name="szolgaltatas_id" required disabled>
                                    <option value="" selected disabled>-- Válassz előbb kategóriát --</option>
                                </select>

                                <div id="szolgaltatasLoader" class="position-absolute top-50 end-0 translate-middle-y me-3 d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. Dolgozó kiválasztása --}}
                        <div class="mb-4 d-none" id="step_dolgozo">
                            <label for="dolgozo_id" class="form-label fw-bold text-uppercase text-muted small">3. Válassz szakembert</label>
                            <div class="position-relative">
                                <select class="form-select form-select-lg shadow-sm border-0 bg-light" id="dolgozo_id" name="dolgozo_id" required disabled>
                                    <option value="" selected disabled>-- Válassz előbb szolgáltatást --</option>
                                </select>
                                {{-- Loading spinner --}}
                                <div id="dolgozoLoader" class="position-absolute top-50 end-0 translate-middle-y me-3 d-none">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>

                        {{-- 4. Dátum kiválasztása --}}
                        <div class="mb-4 d-none" id="step_datum">
                            <label for="datum" class="form-label fw-bold text-uppercase text-muted small">4. Válassz napot</label>
                            <div class="input-group input-group-lg shadow-sm">
                                <span class="input-group-text bg-white border-0"><i class="text-primary">📅</i></span>
                                <input type="text" class="form-control border-0 bg-light flatpickr-input" id="datum" name="datum" placeholder="Kattints a naptárért..." readonly required disabled>
                            </div>
                            <small class="text-muted fst-italic mt-2 d-block">* Csak a szabad napok választhatók.</small>
                        </div>

                        {{-- 5. Időpont kiválasztása --}}
                        <div class="mb-4 d-none" id="step_ido">
                            <label class="form-label fw-bold text-uppercase text-muted small mb-3">5. Válassz szabad időpontot</label>
                            
                            <div id="idopontokContainer" class="d-flex flex-wrap gap-2 justify-content-center p-3 bg-light rounded shadow-inner" style="min-height: 100px;">
                                <p class="text-muted m-auto">Válassz dátumot az időpontok betöltéséhez...</p>
                            </div>
                            
                            {{-- Rejtett input a kiválasztott időpont tárolására --}}
                            <input type="hidden" id="ido_kezdes" name="ido_kezdes" required>
                        </div>

                        {{-- Submit Gomb --}}
                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-dark btn-lg py-3 rounded-pill fw-bold text-uppercase shadow-lg disabled" id="submitBtn">
                                Foglalás véglegesítése
                            </button>
                        </div>

                    </form>
                    @endif {{-- Jogosultság vizsgálat vége --}}
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Ide csúsznak be a Toast értesítések (Sikeres mentéshez) --}}
<div class="toast-container" id="toastContainer"></div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Elemek kiválasztása
    const kategoriaSelect = document.getElementById('lehetoseg_id');
    const szolgaltatasSelect = document.getElementById('szolgaltatas_id');
    const dolgozoSelect = document.getElementById('dolgozo_id');
    const datumInput = document.getElementById('datum');
    const idoInput = document.getElementById('ido_kezdes');
    const idopontokContainer = document.getElementById('idopontokContainer');
    const submitBtn = document.getElementById('submitBtn');
    const alertBox = document.getElementById('alertMessage');

    // Szakaszok
    const stepSzolgaltatas = document.getElementById('step_szolgaltatas');
    const stepDolgozo = document.getElementById('step_dolgozo');
    const stepDatum = document.getElementById('step_datum');
    const stepIdo = document.getElementById('step_ido');
    
    // Loaderek
    const szolgaltatasLoader = document.getElementById('szolgaltatasLoader');
    const dolgozoLoader = document.getElementById('dolgozoLoader');

    let fp = null; // Flatpickr instance

    // --- 0. URL PARAMÉTEREK ELLENŐRZÉSE (Automatikus kitöltés) ---
    // Ez a rész figyeli, hogy jöttünk-e a "Szolgáltatások" oldalról
    const urlParams = new URLSearchParams(window.location.search);
    const preCatId = urlParams.get('category_id');
    const preSvcId = urlParams.get('service_id');

    if (preCatId) {
        kategoriaSelect.value = preCatId;
        loadSzolgaltatasok(preCatId, preSvcId);
    }

    // --- 1. KATEGÓRIA VÁLTÁSAKOR ---
    kategoriaSelect.addEventListener('change', function() {
        loadSzolgaltatasok(this.value);
    });

    // Szolgáltatások betöltése
    function loadSzolgaltatasok(kategoriaId, autoSelectServiceId = null) {
        if(!kategoriaId) return;

        resetSzolgaltatas(); 
        resetDolgozo();
        resetDatum();
        resetIdo();

        stepSzolgaltatas.classList.remove('d-none');
        szolgaltatasLoader.classList.remove('d-none');
        szolgaltatasSelect.disabled = true;

        fetch(`/szolgaltatasok-kategoria-alapjan?lehetoseg_id=${kategoriaId}`)
            .then(response => {
                if (!response.ok) { throw new Error("Hálózati hiba vagy hiányzó útvonal (404)"); }
                return response.json();
            })
            .then(data => {
                szolgaltatasSelect.innerHTML = '<option value="" selected disabled>-- Válassz szolgáltatást --</option>';
                
                if(data.length === 0) {
                     szolgaltatasSelect.innerHTML += '<option value="" disabled>Nincs elérhető szolgáltatás</option>';
                }

                data.forEach(szolg => {
                    const ar = new Intl.NumberFormat('hu-HU').format(szolg.ar);
                    const isSelected = (autoSelectServiceId && parseInt(autoSelectServiceId) === szolg.id) ? 'selected' : '';
                    
                    szolgaltatasSelect.innerHTML += `
                        <option value="${szolg.id}" data-duration="${szolg.idotartam}" ${isSelected}>
                            ${szolg.nev} (${szolg.idotartam} perc) - ${ar} Ft
                        </option>`;
                });

                szolgaltatasSelect.disabled = false;

                if (autoSelectServiceId) {
                    handleSzolgaltatasChange();
                }
            })
            .catch(error => {
                console.error('Hiba:', error);
                alert("Hiba történt a szolgáltatások betöltésekor! Részletek a konzolban (F12).");
            })
            .finally(() => {
                szolgaltatasLoader.classList.add('d-none');
            });
    }

    // --- 2. SZOLGÁLTATÁS VÁLTÁSAKOR -> DOLGOZÓK LEKÉRÉSE ---
    szolgaltatasSelect.addEventListener('change', handleSzolgaltatasChange);

    function handleSzolgaltatasChange() {
        const serviceId = szolgaltatasSelect.value;
        if(!serviceId) return;

        resetDolgozo();
        resetDatum();
        resetIdo();
        
        stepDolgozo.classList.remove('d-none');
        dolgozoLoader.classList.remove('d-none');
        dolgozoSelect.disabled = true;

        fetch(`/dolgozok-szolgaltatas-alapjan?szolgaltatas_id=${serviceId}`)
            .then(response => response.json())
            .then(data => {
                dolgozoSelect.innerHTML = '<option value="" selected disabled>-- Válassz szakembert --</option>';
                data.forEach(dolgozo => {
                    dolgozoSelect.innerHTML += `<option value="${dolgozo.id}">${dolgozo.nev}</option>`;
                });
                dolgozoSelect.disabled = false;
                dolgozoLoader.classList.add('d-none');
            })
            .catch(error => console.error('Hiba:', error));
    }

    // --- 3. DOLGOZÓ VÁLTÁSAKOR -> DÁTUMOK LEKÉRÉSE ---
    dolgozoSelect.addEventListener('change', function() {
        const dolgozoId = this.value;
        const serviceId = szolgaltatasSelect.value;

        if(!dolgozoId) return;

        resetDatum();
        resetIdo();
        
        stepDatum.classList.remove('d-none');

        fetch(`/foglalhato-napok?dolgozo_id=${dolgozoId}&szolgaltatas_id=${serviceId}`)
            .then(res => res.json())
            .then(dates => {
                if(fp) fp.destroy();
                
                fp = flatpickr(datumInput, {
                    locale: "hu",
                    minDate: "today",
                    enable: dates,
                    dateFormat: "Y-m-d",
                    disableMobile: "true",
                    onChange: function(selectedDates, dateStr, instance) {
                        fetchFreeTimes(dateStr);
                    }
                });
                
                datumInput.disabled = false;
                datumInput.placeholder = "Kattints a naptár megnyitásához";
            });
    });

    // --- 4. DÁTUM VÁLTÁSAKOR -> IDŐPONTOK LEKÉRÉSE (SKELETON ANIMÁCIÓVAL) ---
    function fetchFreeTimes(dateStr) {
        const serviceId = szolgaltatasSelect.value;
        const dolgozoId = dolgozoSelect.value;

        stepIdo.classList.remove('d-none');
        
        // Skeleton gombok kirajzolása amíg tölt az adat
        let skeletonHtml = '<div class="w-100 d-flex flex-wrap justify-content-center gap-2">';
        for(let i = 0; i < 8; i++) {
            skeletonHtml += '<div style="width: 70px;"><div class="skeleton-box skeleton-button"></div></div>';
        }
        skeletonHtml += '</div>';
        idopontokContainer.innerHTML = skeletonHtml;
        
        submitBtn.classList.add('disabled');
        
        fetch('/idopontfoglalas/szabad-idopontok', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                szolgaltatas_id: serviceId,
                dolgozo_id: dolgozoId,
                datum: dateStr
            })
        })
        .then(res => res.json())
        .then(data => {
            idopontokContainer.innerHTML = '';
            
            if (data.idopontok.length === 0) {
                idopontokContainer.innerHTML = '<p class="text-danger fw-bold">Erre a napra sajnos minden időpont betelt.</p>';
                return;
            }

            data.idopontok.forEach(time => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-outline-dark m-1 idopont-btn fw-bold';
                btn.innerText = time;
                btn.onclick = function() {
                    document.querySelectorAll('.idopont-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    idoInput.value = time;
                    submitBtn.classList.remove('disabled');
                    submitBtn.innerText = `Foglalás: ${dateStr} ${time}`;
                };
                idopontokContainer.appendChild(btn);
            });
        });
    }

    // --- SEGÉDFÜGGVÉNYEK (RESET) ---
    function resetSzolgaltatas() {
        szolgaltatasSelect.innerHTML = '<option value="" selected disabled>Betöltés...</option>';
        szolgaltatasSelect.disabled = true;
    }
    function resetDolgozo() {
        dolgozoSelect.innerHTML = '<option value="" selected disabled>-- Válassz előbb szolgáltatást --</option>';
        dolgozoSelect.disabled = true;
        stepDolgozo.classList.add('d-none');
    }
    function resetDatum() {
        datumInput.disabled = true;
        datumInput.value = '';
        if(fp) fp.clear();
        stepDatum.classList.add('d-none');
    }
    function resetIdo() {
        idopontokContainer.innerHTML = '';
        idoInput.value = '';
        stepIdo.classList.add('d-none');
        submitBtn.classList.add('disabled');
        submitBtn.innerText = 'Foglalás véglegesítése';
    }

    // --- FORM BEKÜLDÉSE (TOAST ÉRTESÍTÉSSEL) ---
    const form = document.getElementById('bookingForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Feldolgozás...';
        const formData = new FormData(this);

        fetch('/idopontfoglalas/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (response.status === 401) {
                window.location.href = "/login"; 
                throw new Error("Kérjük jelentkezz be!");
            }
            if (!response.ok) throw new Error('Hiba történt a mentéskor.');
            return response.json();
        })
        .then(data => {
            submitBtn.innerHTML = '✔ Foglalás rögzítve!';
            submitBtn.classList.replace('btn-dark', 'btn-success');
            
            // Toast értesítés HTML generálása
            const toastHTML = `
                <div class="custom-toast p-3 d-flex align-items-center gap-3 mt-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                        <i class="fs-5">✔</i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Sikeres foglalás!</h6>
                        <small class="text-muted">${data.uzenet}</small>
                    </div>
                </div>
            `;
            
            const container = document.getElementById('toastContainer');
            container.innerHTML = toastHTML;
            const toastElement = container.querySelector('.custom-toast');
            
            // Animáció indítása
            setTimeout(() => toastElement.classList.add('show'), 100);

            // Form törlése a háttérben
            form.reset();
            kategoriaSelect.value = "";
            stepSzolgaltatas.classList.add('d-none'); 
            resetDolgozo();
            resetDatum();
            resetIdo();
            
            // Átirányítás a profilra
            setTimeout(() => {
                window.location.href = '/profil';
            }, 3000);
        })
        .catch(error => {
            // Hiba esetén marad a piros figyelmeztető doboz
            alertBox.className = 'alert alert-danger alert-custom show mt-3';
            alertBox.innerHTML = `<strong>Hiba:</strong> ${error.message || 'Valami nem sikerült.'}`;
            alertBox.classList.remove('d-none');
            
            submitBtn.disabled = false;
            submitBtn.innerText = 'Próbáld újra';
        });
    });

});
</script>
@endsection

