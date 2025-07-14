{{-- @extends('layouts.auth')

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

    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
@endsection --}}

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
@endsection
