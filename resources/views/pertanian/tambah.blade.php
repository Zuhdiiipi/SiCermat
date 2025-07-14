{{-- filepath: c:\laragon\www\SiCermat\resources\views\komoditas\create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Komoditas Pertanian</h2>
    <form action="{{ route('komoditas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Komoditas</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Komoditas</label>
            <input type="text" class="form-control" id="jenis" name="jenis" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection