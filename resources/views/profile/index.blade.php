@extends('layouts.app')

@section('content')

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="mb-4">Profilom</h2>

    <div class="card p-3 shadow mb-4">
        <h4 class="fw-bold">{{ $felhasznalo->nev }}</h4>
        <p><strong>Email:</strong> {{ $felhasznalo->email }}</p>
        <p><strong>Telefon:</strong> {{ $felhasznalo->telefonszam }}</p>
        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-2">Adataim módosítása</a>
    </div>

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
                    <td>{{ $f->statusz->nev }}</td>
                    <td>
                        <form action="{{ route('profile.cancel', $f->id) }}" method="POST" onsubmit="return confirm('Biztos törlöd?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Lemondás</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
