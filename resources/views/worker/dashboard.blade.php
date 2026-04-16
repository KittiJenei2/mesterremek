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
                            <label for="datum_kezdes" class="form-label small fw-bold text-muted">Kezdő dátum</label>
                            <input type="date" id="datum_kezdes" name="datum_kezdes" class="form-control border-0 bg-light @error('datum_kezdes') is-invalid @enderror" required min="{{ date('Y-m-d') }}" value="{{ old('datum_kezdes') }}">
                            @error('datum_kezdes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-4">
                            <label for="datum_vege" class="form-label small fw-bold text-muted">Utolsó nap</label>
                            <input type="date" id="datum_vege" name="datum_vege" class="form-control border-0 bg-light @error('datum_vege') is-invalid @enderror" required min="{{ date('Y-m-d') }}" value="{{ old('datum_vege') }}">
                            @error('datum_vege') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill fw-bold">
                                Szabadság rögzítése
                            </button>
                        </div>
                    </form>
                    <hr class="my-4">
                    <h6 class="fw-bold mb-3 text-dark">Rögzített jövőbeli szabadságaid</h6>
                    
                    @php
                        // Lekérjük a dolgozó jövőbeli szabadságait közvetlenül
                        $jovobeliSzabadsagok = App\Models\Szabadsagok::where('dolgozo_id', $dolgozo->id)
                            ->where('datum_vege', '>=', now()->toDateString())
                            ->orderBy('datum_kezdes')
                            ->get();
                    @endphp

                    @if($jovobeliSzabadsagok->isEmpty())
                        <p class="small text-muted">Nincs rögzített jövőbeli szabadságod.</p>
                    @else
                        <div class="list-group list-group-flush rounded-3 shadow-sm">
                            @foreach($jovobeliSzabadsagok as $sz)
                                <div class="list-group-item d-flex justify-content-between align-items-center bg-white border-0 py-3">
                                    <div>
                                        <div class="small fw-bold text-danger">{{ $sz->datum_kezdes }} <span class="text-muted fw-normal mx-1">/</span> {{ $sz->datum_vege }}</div>
                                    </div>
                                    
                                    <div class="d-flex gap-2">
                                        {{-- SZERKESZTÉS GOMB --}}
                                        <button type="button" class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#editModal{{ $sz->id }}">
                                            <i>✏️</i> Szerkesztés
                                        </button>

                                        {{-- TÖRLÉS GOMB --}}
                                        <button type="button" class="btn btn-sm btn-outline-danger border-0" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sz->id }}">
                                            <i>🗑</i> Törlés
                                        </button>
                                    </div>
                                </div>

                                {{-- MODAL: SZERKESZTÉS --}}
                                <div class="modal fade" id="editModal{{ $sz->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sz->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <form action="{{ route('worker.vacation.update', $sz->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title fw-bold" id="editModalLabel{{ $sz->id }}">Szabadság módosítása</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                                                </div>
                                                <div class="modal-body py-3">
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Kezdő dátum</label>
                                                        <input type="date" name="datum_kezdes" class="form-control bg-light border-0 edit-kezdes" 
                                                            value="{{ $sz->datum_kezdes }}" required min="{{ date('Y-m-d') }}" data-id="{{ $sz->id }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label small fw-bold text-muted">Utolsó nap</label>
                                                        <input type="date" name="datum_vege" class="form-control bg-light border-0 edit-vege" 
                                                            value="{{ $sz->datum_vege }}" required min="{{ $sz->datum_kezdes }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-top-0 pt-0">
                                                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Mégsem</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">Mentés</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- MODAL: TÖRLÉS --}}
                                <div class="modal fade" id="deleteModal{{ $sz->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $sz->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-4">
                                            <div class="modal-header border-bottom-0 pb-0">
                                                <h5 class="modal-title fw-bold text-danger" id="deleteModalLabel{{ $sz->id }}">Szabadság törlése</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                                            </div>
                                            
                                            <div class="modal-body py-4">
                                                <p class="mb-1 text-center">Biztosan törölni szeretnéd a következő szabadságodat?</p>
                                                <p class="fw-bold fs-5 text-dark text-center my-3 bg-light rounded py-3 border">
                                                    {{ $sz->datum_kezdes }} <br><span class="text-muted fs-6">⬇</span><br> {{ $sz->datum_vege }}
                                                </p>
                                                <p class="small text-muted mb-0 text-center">Ez a művelet nem vonható vissza, és a naptárad azonnal felszabadul ezeken a napokon.</p>
                                            </div>
                                            
                                            <div class="modal-footer border-top-0 pt-0 justify-content-center gap-2">
                                                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold shadow-sm" data-bs-dismiss="modal">Mégsem</button>
                                                
                                                <form action="{{ route('worker.vacation.destroy', $sz->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                                                        Igen, törlöm
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ÚJ: NAPTÁR NÉZET SZEKCIÓ (Teljes szélességben a táblázatok alatt) --}}
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-4 p-4 mb-5 bg-white">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
                    <h4 class="fw-bold m-0">🗓 Beosztás Naptár</h4>
                    <div>
                        <span class="badge bg-warning text-dark me-2">Függőben</span>
                        <span class="badge bg-success me-2">Elfogadva</span>
                        <span class="badge bg-primary me-2">Elvégezve</span>
                        <span class="badge bg-danger">Szabadság</span>
                    </div>
                </div>
                
                {{-- Ide rajzolja ki a JS a naptárat --}}
                <div id="calendar" style="min-height: 600px;"></div>
            </div>
        </div>
    </div>

</div>
@endsection

{{-- NAPTÁR JAVASCRIPT KÓDJA --}}
@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        
        // A WorkerControllerből kapott JSON adat (ha létezik, különben üres tömb)
        var calendarEvents = @json($calendarEvents ?? []);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek', // Heti beosztás
            locale: 'hu',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Ma',
                month: 'Hónap',
                week: 'Hét',
                day: 'Nap'
            },
            firstDay: 1, // Hétfő
            slotMinTime: '08:00:00', // Szalon nyitás
            slotMaxTime: '20:00:00', // Szalon zárás
            allDaySlot: true,
            allDayText: 'Egész nap',
            events: calendarEvents,
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false
            }
        });
        
        calendar.render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kezdesInput = document.getElementById('datum_kezdes');
        const vegeInput = document.getElementById('datum_vege');

        if (kezdesInput && vegeInput) {
            kezdesInput.addEventListener('change', function() {
                // Amikor a kezdő dátumot kiválasztja a dolgozó, 
                // a befejező dátum naptárában a minimum választható nap a kezdő dátum lesz.
                vegeInput.min = this.value;
                
                // Ha a befejező dátum már ki volt töltve, és az korábbi, mint az új kezdő dátum, 
                // akkor automatikusan átugratjuk ugyanarra a napra.
                if (vegeInput.value && vegeInput.value < this.value) {
                    vegeInput.value = this.value;
                }
            });
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // 1. Összegyűjtjük a Laravelből a jövőbeli szabadságokat
        const allVacations = [
            @foreach($jovobeliSzabadsagok as $sz)
                { id: {{ $sz->id }}, from: "{{ $sz->datum_kezdes }}", to: "{{ $sz->datum_vege }}" },
            @endforeach
        ];

        // 2. Segédfüggvény a záró dátum (Utolsó nap) korlátozására
        function updateEndDateConstraints(startDateStr, endDatePicker, disableRanges) {
            // A vége nem lehet korábban, mint a kezdete
            endDatePicker.set('minDate', startDateStr);

            let start = new Date(startDateStr);
            let nextDisabledDate = null;

            // Keresünk egy olyan letiltott időszakot, ami a kiválasztott kezdés UTÁN van
            let sortedRanges = [...disableRanges].sort((a, b) => new Date(a.from) - new Date(b.from));
            for (let range of sortedRanges) {
                let rangeStart = new Date(range.from);
                if (rangeStart > start) {
                    nextDisabledDate = rangeStart;
                    break; // Megtaláltuk a legelső ütközést
                }
            }

            // Ha van ilyen, akkor a maximálisan választható nap az ütközés ELŐTTI nap lesz
            if (nextDisabledDate) {
                let maxDate = new Date(nextDisabledDate);
                maxDate.setDate(maxDate.getDate() - 1);
                endDatePicker.set('maxDate', maxDate);
            } else {
                endDatePicker.set('maxDate', null); // Nincs felső korlát
            }
        }

        // --- ÚJ SZABADSÁG RÖGZÍTÉSE ---
        // Itt az összes meglévő szabadságot tiltjuk
        const newDisableRanges = allVacations.map(v => ({ from: v.from, to: v.to }));

        const newVegePicker = flatpickr("#datum_vege", {
            locale: "hu",
            minDate: "today",
            disable: newDisableRanges
        });

        const newKezdesPicker = flatpickr("#datum_kezdes", {
            locale: "hu",
            minDate: "today",
            disable: newDisableRanges,
            onChange: function(selectedDates, dateStr) {
                // Amikor kiválasztják a kezdetét, frissítjük a végét korlátozó szabályokat
                updateEndDateConstraints(dateStr, newVegePicker, newDisableRanges);
            }
        });

        // --- MEGLÉVŐ SZABADSÁGOK SZERKESZTÉSE ---
        document.querySelectorAll('.modal').forEach(modal => {
            const editKezdesInput = modal.querySelector('.edit-kezdes');
            const editVegeInput = modal.querySelector('.edit-vege');

            if (editKezdesInput && editVegeInput) {
                const currentId = editKezdesInput.dataset.id;

                // Az aktuálisan szerkesztett szabadságot KIVESSZÜK a letiltottak közül
                const editDisableRanges = allVacations
                    .filter(v => v.id != currentId)
                    .map(v => ({ from: v.from, to: v.to }));

                const editVegePicker = flatpickr(editVegeInput, {
                    locale: "hu",
                    minDate: "today",
                    disable: editDisableRanges
                });

                const editKezdesPicker = flatpickr(editKezdesInput, {
                    locale: "hu",
                    minDate: "today",
                    disable: editDisableRanges,
                    onChange: function(selectedDates, dateStr) {
                        updateEndDateConstraints(dateStr, editVegePicker, editDisableRanges);
                    }
                });

                // Inicializáláskor is beállítjuk a max/min értékeket a már meglévő adatok alapján
                if (editKezdesInput.value) {
                    updateEndDateConstraints(editKezdesInput.value, editVegePicker, editDisableRanges);
                    // Mivel a fenti függvény reseteli, visszaállítjuk az eredeti mentett értéket
                    editVegePicker.setDate(editVegeInput.value); 
                }
            }
        });

    });
</script>


@endsection