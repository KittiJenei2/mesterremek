@extends('layouts.app')

@section('content')

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

    if (!e.target.classList.contains("lemondBtn")) return;

    const id = e.target.dataset.id;

    if (!confirm("Biztosan le szeretnéd mondani a foglalást?")) return;

    fetch(`/foglalas/${id}/cancel`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
    })
    .then(res => res.json())
    .then(data => {
        alert(data.uzenet);
        location.reload();
    })
    .catch(err => {
        alert("Hiba történt a lemondás során.");
        console.error(err);
    });

});
</script>

@endsection
