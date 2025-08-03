{{-- 
@extends('layouts.auth')

@section('content')
<h4 class="mb-4 text-center">Login</h4>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary w-50">Home</a>
        <button type="submit" class="btn btn-primary w-50">Login</button>
    </div>
</form>
@endsection --}}

@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    {{-- <img src="{{ asset('logo.png') }}" alt="Logo" class="brand-logo mb-2"> --}}
    <h4 class="fw-bold">SICERMAT</h4>
    <p class="text-muted">Sistem Informasi Cek Harga Komoditas</p>
</div>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" class="form-control" name="email" placeholder="you@example.com" required autofocus>
        </div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" name="password" placeholder="********" required>
        </div>
    </div>

    <div class="d-flex justify-content-between gap-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary w-50">Home</a>
        <button type="submit" class="btn btn-primary w-50">Login</button>
    </div>
</form>
@endsection
