@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4 pb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Profilom</h2>
    </div>

    {{-- Sikerüzenet --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    {{-- Hibaüzenet --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- 1. FELHASZNÁLÓI ADATOK KÁRTYA --}}
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

        {{-- 2. FOGLALÁSOK LISTÁJA --}}
        <div class="col-lg-8">
            
            {{-- A) AKTUÁLIS FOGLALÁSOK (Jövőbeli) --}}
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
                                        <th class="text-end">Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aktualis_foglalasok as $f)
                                        <tr>
                                            <td class="fw-bold">{{ $f->datum }}</td>
                                            <td>{{ substr($f->ido_kezdes, 0, 5) }} - {{ substr($f->ido_vege, 0, 5) }}</td>
                                            <td>{{ $f->szolgaltatas->nev }}</td>
                                            <td>{{ $f->dolgozo->nev }}</td>
                                            <td>
                                                <span class="badge rounded-pill {{ $f->statuszok_id == 2 ? 'bg-success' : 'bg-warning text-dark' }}">
                                                    {{ $f->statusz->nev ?? 'Függőben' }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <button class="btn btn-danger btn-sm rounded-pill px-3 lemondBtn" data-id="{{ $f->id }}">
                                                    Lemondás
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            {{-- B) KORÁBBI FOGLALÁSOK (Múltbeli + Visszajelzés) --}}
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
                                                    {{-- Ha már írt véleményt, csillagokat mutatunk --}}
                                                    <div class="text-warning" title="{{ $f->velemeny->velemeny }}">
                                                        @for($i = 0; $i < $f->velemeny->ertekeles; $i++) ★ @endfor
                                                        @for($i = $f->velemeny->ertekeles; $i < 5; $i++) ☆ @endfor
                                                    </div>
                                                @else
                                                    {{-- Ha még nem, akkor gomb --}}
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

{{-- VISSZAJELZÉS MODAL --}}
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">Visszajelzés küldése</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Bezár"></button>
            </div>
            <form action="{{ route('profile.feedback.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="idopont_id" id="modal_idopont_id">
                    
                    <p class="text-muted mb-3">Hogy tetszett a szolgáltatás: <strong id="modal_szolgaltatas_nev" class="text-dark"></strong>?</p>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Értékelés</label>
                        <select name="ertekeles" class="form-select bg-light border-0" required>
                            <option value="5" selected>⭐⭐⭐⭐⭐ (Kiváló)</option>
                            <option value="4">⭐⭐⭐⭐ (Jó)</option>
                            <option value="3">⭐⭐⭐ (Közepes)</option>
                            <option value="2">⭐⭐ (Gyenge)</option>
                            <option value="1">⭐ (Rossz)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Véleményed (Opcionális)</label>
                        <textarea name="velemeny" class="form-control bg-light border-0" rows="3" placeholder="Írd le a tapasztalataidat..."></textarea>
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

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- 1. LEMONDÁS KEZELÉSE (A te eredeti kódod alapján) ---
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
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                    })
                    .then(res => {
                        if (!res.ok) { 
                            return res.json().then(json => { throw new Error(json.uzenet || 'Hiba történt') });
                        }
                        return res.json();
                    })
                    .then(data => {
                        Swal.fire('Törölve!', data.uzenet, 'success')
                            .then(() => location.reload());
                    })
                    .catch(err => {
                        Swal.fire('Hiba!', err.message, 'error');
                        console.error(err);
                    });
                }
            });
        }
    });

    // --- 2. VISSZAJELZÉS MODAL KEZELÉSE (Az új rész) ---
    const feedbackModal = document.getElementById('feedbackModal');
    if (feedbackModal) {
        feedbackModal.addEventListener('show.bs.modal', event => {
            // Gomb, ami megnyitotta a modalt
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-szolgaltatas');

            // Adatok betöltése a modal mezőibe
            feedbackModal.querySelector('#modal_idopont_id').value = id;
            feedbackModal.querySelector('#modal_szolgaltatas_nev').textContent = title;
        });
    }

});
</script>
@endsection