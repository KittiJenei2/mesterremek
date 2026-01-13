@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">

    <h2 class="mb-4">Profilom</h2>

    {{-- Sikerüzenet --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FELHASZNÁLÓI ADATOK --}}
    <div class="card p-3 shadow mb-4">
        <h4 class="fw-bold">{{ $felhasznalo->nev }}</h4>
        <p><strong>Email:</strong> {{ $felhasznalo->email }}</p>
        <p><strong>Telefon:</strong> {{ $felhasznalo->telefonszam }}</p>

        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-2">
            Adataim módosítása
        </a>
    </div>

    {{-- FOGALÁSOK --}}
    <h3>Foglalásaim</h3>

    <table class="table table-striped shadow mt-3">
        <thead class="table-dark">
            <tr>
                <th>Dátum</th>
                <th>Kezdés</th>
                <th>Vége</th>
                <th>Szolgáltatás</th>
                <th>Dolgozó</th>
                <th>Státusz</th>
                <th>Művelet</th>
            </tr>
        </thead>

        <tbody>
            @foreach($foglalasok as $f)
                <tr>
                    <td>{{ $f->datum }}</td>
                    <td>{{ $f->ido_kezdes }}</td>
                    <td>{{ $f->ido_vege }}</td>
                    <td>{{ $f->szolgaltatas->nev }}</td>
                    <td>{{ $f->dolgozo->nev }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $f->statusz->nev }}
                        </span>
                    </td>

                    <td>
                        {{-- Csak jövőbeli foglalás mondható le --}}
                        @if(strtotime($f->datum) >= strtotime('today'))

                            <button class="btn btn-danger btn-sm lemondBtn"
                                data-id="{{ $f->id }}">
                                Lemondás
                            </button>

                        @else
                            <span class="text-muted">Nem lemondható</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>


{{-- AJAX SCRIPT --}}
<script>
document.addEventListener("click", function(e) {

    // Csak akkor fusson le, ha a "lemondBtn" osztályú gombra kattintottak
    if (!e.target.classList.contains("lemondBtn")) return;

    const id = e.target.dataset.id;

    // Szép megerősítő ablak (SweetAlert2)
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
            
            // Ha igent nyomott, indul a kérés
            fetch(`/foglalas/${id}/cancel`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
            })
            .then(res => {
                if (!res.ok) { 
                    // Ha a szerver hibát dob (pl. 400 vagy 404), itt kapjuk el
                    return res.json().then(json => { throw new Error(json.uzenet || 'Hiba történt') });
                }
                return res.json();
            })
            .then(data => {
                // SIKERES TÖRLÉS -> Szép üzenet
                Swal.fire(
                    'Törölve!',
                    data.uzenet,
                    'success'
                ).then(() => {
                    // Ha leokézta az üzenetet, újratöltjük az oldalt
                    location.reload();
                });
            })
            .catch(err => {
                // HIBA -> Szép hibaüzenet
                Swal.fire(
                    'Hiba!',
                    err.message,
                    'error'
                );
                console.error(err);
            });
        }
    })

});
</script>

@endsection
