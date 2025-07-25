@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Akun Petugas</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="petugas_pertanian" {{ $user->role == 'petugas_pertanian' ? 'selected' : '' }}>Petugas Pertanian</option>
                <option value="petugas_perikanan" {{ $user->role == 'petugas_perikanan' ? 'selected' : '' }}>Petugas Perikanan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sector" class="form-control" required>
                <option value="pertanian" {{ $user->sector == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                <option value="perikanan" {{ $user->sector == 'perikanan' ? 'selected' : '' }}>Perikanan</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
