@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <h3>Daftar Komoditas - {{ ucfirst(Auth::user()->sector) }}</h3> --}}
    <h3>Daftar Komoditas Perikanan</h3>
    <a href="{{ route('perikanan.create') }}" class="btn btn-primary mb-3">+ Tambah Komoditas</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Komoditas</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commodities as $commodity)
                <tr>
                    <td>{{ $commodity->name }}</td>
                    <td>{{ $commodity->unit }}</td>
                    <td>
                        <a href="{{ route('perikanan.edit', $commodity) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('perikanan.destroy', $commodity) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
