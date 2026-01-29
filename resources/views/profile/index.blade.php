@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4 pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Profilom</h2>
    </div>

    {{-- Visszajelzések --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- 1. ADATOK --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex p-3">
                            <i class="fs-1">👤</i>
                        </div>
                    </div>
                    <h4 class="fw-bold mb-1">{{ $felhasznalo->nev }}</h4>
                    <p class="text-muted mb-4">Regisztrált felhasználó</p>
                    
                    <ul class="list-group list-group-flush text-start mb-4">
                        <li class="list-group-item border-0 px-0">
                            <strong>Email:</strong> <br> {{ $felhasznalo->email }}
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <strong>Telefon:</strong> <br> {{ $felhasznalo->telefonszam }}
                        </li>
                    </ul>

                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary rounded-pill w-100 fw-bold">
                        Adataim módosítása
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. FOGLALÁSOK --}}
        <div class="col-lg-8">
            
            {{-- A) AKTUÁLIS --}}
            <h4 class="fw-bold mb-3 text-primary">📅 Aktuális foglalásaim</h4>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                <div class="card-body p-0">
                    @if($aktualis_foglalasok->isEmpty())
                        <div class="p-4 text-center text-muted">
                            <p class="mb-0">Nincs közelgő időpontod.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Dátum</th>
                                        <th>Időpont</th>
                                        <th>Szolgáltatás</th>
                                        <th>Szakember</th>
                                        <th>Státusz</th>
                                        <th class="text-end pe-4">Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aktualis_foglalasok as $f)
                                        <tr>
                                            <td class="fw-bold">{{ $f->datum }}</td>
                                            <td>{{ substr($f->ido_kezdes, 0, 5) }}</td>
                                            <td>{{ $f->szolgaltatas->nev }}</td>
                                            <td>{{ $f->dolgozo->nev }}</td>
                                            <td>
                                                <span class="badge rounded-pill {{ $f->statuszok_id == 2 ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ $f->statusz->nev ?? 'Függőben' }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    
                                                    {{-- MÓDOSÍTÁS GOMB (Csak 2 órával előtte) --}}
                                                    @php
                                                        $start = \Carbon\Carbon::parse($f->datum . ' ' . $f->ido_kezdes);
                                                        $canModify = now()->addHours(2)->lt($start);
                                                    @endphp

                                                    @if($canModify)
                                                        <button class="btn btn-warning btn-sm rounded-pill px-3 modifyBtn"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modifyModal"
                                                                data-id="{{ $f->id }}"
                                                                data-datum="{{ $f->datum }}"
                                                                data-szolgaltatas-id="{{ $f->szolgaltatasok_id }}"
                                                                data-dolgozo-id="{{ $f->dolgozo_id }}">
                                                            Módosít
                                                        </button>
                                                    @endif

                                                    <button class="btn btn-danger btn-sm rounded-pill px-3 lemondBtn" data-id="{{ $f->id }}">
                                                        Lemond
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- B) KORÁBBI --}}
            <h4 class="fw-bold mb-3 text-secondary">📜 Korábbi foglalások</h4>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    @if($korabbi_foglalasok->isEmpty())
                        <div class="p-4 text-center text-muted">
                            <p class="mb-0">Még nem volt nálunk foglalásod.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>Dátum</th>
                                        <th>Szolgáltatás</th>
                                        <th>Szakember</th>
                                        <th class="text-center">Visszajelzés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($korabbi_foglalasok as $f)
                                        <tr>
                                            <td class="text-muted fw-bold">{{ $f->datum }}</td>
                                            <td>{{ $f->szolgaltatas->nev }}</td>
                                            <td>{{ $f->dolgozo->nev }}</td>
                                            <td class="text-center">
                                                @if($f->velemeny)
                                                    <div class="text-warning" title="{{ $f->velemeny->velemeny }}">
                                                        @for($i = 0; $i < $f->velemeny->ertekeles; $i++) ★ @endfor
                                                        @for($i = $f->velemeny->ertekeles; $i < 5; $i++) ☆ @endfor
                                                    </div>
                                                @else
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill feedbackBtn px-3"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#feedbackModal"
                                                            data-id="{{ $f->id }}"
                                                            data-szolgaltatas="{{ $f->szolgaltatas->nev }}">
                                                        Értékelés
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

{{-- 1. VISSZAJELZÉS MODAL --}}
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Visszajelzés küldése</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.feedback.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="idopont_id" id="modal_feedback_id">
                    <p class="text-muted mb-3">Hogy tetszett: <strong id="modal_feedback_name" class="text-dark"></strong>?</p>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Értékelés</label>
                        <select name="ertekeles" class="form-select bg-light border-0" required>
                            <option value="5">⭐⭐⭐⭐⭐ (Kiváló)</option>
                            <option value="4">⭐⭐⭐⭐ (Jó)</option>
                            <option value="3">⭐⭐⭐ (Közepes)</option>
                            <option value="2">⭐⭐ (Gyenge)</option>
                            <option value="1">⭐ (Rossz)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Vélemény</label>
                        <textarea name="velemeny" class="form-control bg-light border-0" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Mégse</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">Küldés</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 2. MÓDOSÍTÁS MODAL (ÚJ) --}}
<div class="modal fade" id="modifyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold">Időpont módosítása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <form id="modifyForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body p-4">
                    <p class="text-muted">A foglalás dátuma változatlan marad: <strong id="modal_modify_datum" class="text-dark"></strong></p>
                    <p class="small text-muted mb-3">Kérlek válassz egy új kezdési időpontot a szabad helyek közül:</p>

                    <div id="loadingTimes" class="text-center d-none">
                        <div class="spinner-border text-warning" role="status"></div>
                        <p class="small mt-2">Szabad időpontok betöltése...</p>
                    </div>

                    <div id="timesContainer" class="d-flex flex-wrap gap-2 justify-content-center">
                        {{-- Ide töltjük be a gombokat JS-sel --}}
                    </div>
                    
                    <input type="hidden" name="ido_kezdes" id="modal_modify_time" required>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Mégse</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold disabled" id="saveModifyBtn">
                        Módosítás mentése
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- 1. LEMONDÁS (Régi) ---
    document.body.addEventListener("click", function(e) {
        if (e.target.classList.contains("lemondBtn")) {
            const id = e.target.dataset.id;
            Swal.fire({
                title: 'Biztosan lemondod?',
                text: "A foglalás véglegesen törlődik!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Igen, törlöm!',
                cancelButtonText: 'Mégsem'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/foglalas/${id}/cancel`, {
                        method: "POST",
                        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                    }).then(res => {
                        if (!res.ok) return res.json().then(json => { throw new Error(json.uzenet || 'Hiba') });
                        return res.json();
                    }).then(data => {
                        Swal.fire('Törölve!', data.uzenet, 'success').then(() => location.reload());
                    }).catch(err => Swal.fire('Hiba!', err.message, 'error'));
                }
            });
        }
    });

    // --- 2. VISSZAJELZÉS MODAL ---
    const feedbackModal = document.getElementById('feedbackModal');
    if (feedbackModal) {
        feedbackModal.addEventListener('show.bs.modal', event => {
            const btn = event.relatedTarget;
            feedbackModal.querySelector('#modal_feedback_id').value = btn.getAttribute('data-id');
            feedbackModal.querySelector('#modal_feedback_name').textContent = btn.getAttribute('data-szolgaltatas');
        });
    }

    // --- 3. MÓDOSÍTÁS MODAL (ÚJ) ---
    const modifyModal = document.getElementById('modifyModal');
    if (modifyModal) {
        const loading = document.getElementById('loadingTimes');
        const container = document.getElementById('timesContainer');
        const saveBtn = document.getElementById('saveModifyBtn');
        const timeInput = document.getElementById('modal_modify_time');
        const form = document.getElementById('modifyForm');

        modifyModal.addEventListener('show.bs.modal', event => {
            const btn = event.relatedTarget;
            const id = btn.getAttribute('data-id');
            const datum = btn.getAttribute('data-datum');
            const szolgId = btn.getAttribute('data-szolgaltatas-id');
            const dolgId = btn.getAttribute('data-dolgozo-id');

            // Form action beállítása
            form.action = `/profil/foglalas/${id}/modositas`;
            
            // UI reset
            document.getElementById('modal_modify_datum').textContent = datum;
            container.innerHTML = '';
            loading.classList.remove('d-none');
            saveBtn.classList.add('disabled');
            timeInput.value = '';

            // Szabad időpontok lekérése a meglévő API-val
            fetch('/idopontfoglalas/szabad-idopontok', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    szolgaltatas_id: szolgId,
                    dolgozo_id: dolgId,
                    datum: datum
                })
            })
            .then(res => res.json())
            .then(data => {
                loading.classList.add('d-none');
                container.innerHTML = '';

                if (data.idopontok.length === 0) {
                    container.innerHTML = '<p class="text-danger">Sajnos nincs más szabad időpont ezen a napon.</p>';
                    return;
                }

                // Gombok generálása
                data.idopontok.forEach(time => {
                    const timeBtn = document.createElement('button');
                    timeBtn.type = 'button';
                    timeBtn.className = 'btn btn-outline-dark m-1 time-select-btn fw-bold';
                    timeBtn.innerText = time;
                    
                    timeBtn.onclick = function() {
                        // Aktív státusz kezelése
                        document.querySelectorAll('.time-select-btn').forEach(b => b.classList.remove('active', 'btn-dark'));
                        document.querySelectorAll('.time-select-btn').forEach(b => b.classList.add('btn-outline-dark'));
                        
                        this.classList.remove('btn-outline-dark');
                        this.classList.add('active', 'btn-dark');
                        
                        // Érték beírása
                        timeInput.value = time;
                        saveBtn.classList.remove('disabled');
                        saveBtn.innerText = `Átrakás erre: ${time}`;
                    };
                    
                    container.appendChild(timeBtn);
                });
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<p class="text-danger">Hiba történt a betöltéskor.</p>';
                loading.classList.add('d-none');
            });
        });
    }

});
</script>
@endsection