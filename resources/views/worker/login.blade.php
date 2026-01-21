@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-4 rounded-top-4">
                    <h4 class="mb-0 fw-bold">Dolgozói Belépés</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('worker.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold small">Email cím</label>
                            <input type="email" name="email" class="form-control form-control-lg bg-light border-0" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted fw-bold small">Jelszó</label>
                            <input type="password" name="password" class="form-control form-control-lg bg-light border-0" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg rounded-pill fw-bold">Belépés</button>
                    </form>
                    
                    @if($errors->any())
                        <div class="alert alert-danger mt-3 text-center border-0 small">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection