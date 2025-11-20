@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Profil adatainak módosítása</h2>

    <form action="{{ route('profile.update') }}" method="POST" class="card p-4 shadow mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Név</label>
            <input type="text" class="form-control" name="nev" value="{{ $felhasznalo->nev }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email cím</label>
            <input type="email" class="form-control" name="email" value="{{ $felhasznalo->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefonszám</label>
            <input type="text" class="form-control" name="telefonszam" value="{{ $felhasznalo->telefonszam }}">
        </div>

        <button class="btn btn-success">Mentés</button>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">Mégse</a>

    </form>

</div>
@endsection
