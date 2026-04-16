@extends('layouts.app')

@section('content')

{{-- Fejléc --}}
<div class="bg-dark text-white py-5 mb-5 text-center">
    <h1 class="display-4 fw-bold text-uppercase">Kollégáink</h1>
    <p class="lead text-white-50">Ismerd meg szakértő csapatunkat és történetüket</p>
</div>

<div class="container pb-5">
    <div class="row g-5">
        @foreach($allDolgozo as $dolgozo)
            <div class="col-lg-6">
                {{-- Hozzáadtuk a 'dolgozo-card' osztályt --}}
                <div class="card border-0 shadow-lg overflow-hidden rounded-4 h-100 dolgozo-card">
                    <div class="row g-0 h-100">
                        
                        {{-- Bal oldal: Kép --}}
                        <div class="col-md-5">
                            <img src="{{ asset('images/dolgozok/' . $dolgozo->kep) }}" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $dolgozo->nev }}"
                                 style="min-height: 300px;"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($dolgozo->nev) }}&size=300';">
                        </div>

                        {{-- Jobb oldal: Adatok + Bio --}}
                        <div class="col-md-7">
                            <div class="card-body p-4 d-flex flex-column h-100 justify-content-center">
                                <h3 class="fw-bold mb-2">{{ $dolgozo->nev }}</h3>
                                
                                <p class="text-primary mb-3 fw-bold small">
                                    <i class="bi bi-envelope-fill me-2"></i>{{ $dolgozo->email }}
                                </p>

                                <hr class="opacity-25 my-2">

                                <p class="text-muted fst-italic mb-0">
                                    {{ $dolgozo->bio ?? 'Sok szeretettel várom régi és új vendégeimet!' }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection