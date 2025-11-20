@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Bejelentkezés</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email:</label>
        <input type="email" name="email" class="form-control" required>

        <label>Jelszó:</label>
        <input type="password" name="jelszo" class="form-control" required>

        <button class="btn btn-success mt-3">Bejelentkezés</button>
    </form>

</div>
@endsection