@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Fejléc --}}
    <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
        <div>
            <h2 class="fw-bold m-0">Szia, {{ $dolgozo->nev }}!</h2>
            <p class="text-muted m-0">Itt láthatod a beosztásodat és foglalásaidat.</p>
        </div>
        <form method="POST" action="{{ route('worker.logout') }}">
            @csrf
            <button class="btn btn-outline-danger px-4 rounded-pill fw-bold">Kijelentkezés</button>
        </form>
    </div>

    {{-- Üzenetek --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm">
            <strong>Siker!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- 1. FOGLALÁSOK LISTÁJA --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-bottom-0">
                    <h5 class="fw-bold m-0">📅 Érkező Vendégek</h5>
                </div>
                <div class="card-body p-0">
                    @if($foglalasok->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fs-1 opacity-25 mb-2">📭</i>
                            <p>Nincs új foglalásod a közeljövőben.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-4">Időpont</th>
                                        <th>Vendég</th>
                                        <th>Szolgáltatás</th>
                                        <th>Státusz</th>
                                        <th class="text-end pe-4">Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($foglalasok as $foglalas)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="fw-bold">{{ $foglalas->datum }}</div>
                                                <small class="text-muted">{{ substr($foglalas->ido_kezdes, 0, 5) }}</small>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $foglalas->felhasznalo->nev }}</div>
                                                <a href="tel:{{ $foglalas->felhasznalo->telefonszam }}" class="text-decoration-none small text-primary">
                                                    {{ $foglalas->felhasznalo->telefonszam }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border">{{ $foglalas->szolgaltatas->nev }}</span>
                                            </td>
                                            <td>
                                                @if($foglalas->statuszok_id == 1)
                                                    <span class="badge bg-warning text-dark">Függőben</span>
                                                @elseif($foglalas->statuszok_id == 2)
                                                    <span class="badge bg-success">Elfogadva</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $foglalas->statusz->nev ?? 'Egyéb' }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                {{-- Ha "Függőben" (1) van, akkor megjelenik a gomb --}}
                                                @if($foglalas->statuszok_id == 1)
                                                    <form action="{{ route('worker.status.accept', $foglalas->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                                                            Elfogadás
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted small">🔒 Lezárva</span>
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

        {{-- 2. SZABADSÁG FELVITELE --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100 rounded-4 bg-primary bg-opacity-10">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3 text-primary">🏖 Szabadság igénylése</h5>
                    <p class="small text-muted mb-4">Add meg, mikor nem tudsz vendégeket fogadni. Ez letiltja a foglalást azokra a napokra.</p>
                    
                    <form action="{{ route('worker.vacation.store') }}" method="POST" class="bg-white p-3 rounded-3 shadow-sm">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kezdő dátum</label>
                            <input type="date" name="datum_kezdes" class="form-control border-0 bg-light" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Utolsó nap</label>
                            <input type="date" name="datum_vege" class="form-control border-0 bg-light" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold">
                                Szabadság rögzítése
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection