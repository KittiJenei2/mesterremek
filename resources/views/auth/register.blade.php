@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Regisztráció</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Név:</label>
        <input type="text" name="nev" class="form-control" required>

        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>

        <label>Telefon:</label>
        <input type="text" name="telefonszam" class="form-control">

        <label>Jelszó:</label>
        <input type="password" name="jelszo" class="form-control" required>

        <button class="btn btn-primary mt-3">Regisztráció</button>
    </form>

</div>
@endsection