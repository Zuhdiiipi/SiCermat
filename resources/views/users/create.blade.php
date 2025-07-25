@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Akun Petugas</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                <option value="petugas_pertanian">Petugas Pertanian</option>
                <option value="petugas_perikanan">Petugas Perikanan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Sektor</label>
            <select name="sector" class="form-control" required>
                <option value="">-- Pilih Sektor --</option>
                <option value="pertanian">Pertanian</option>
                <option value="perikanan">Perikanan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
