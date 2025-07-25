@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h3>Daftar Komoditas - {{ ucfirst(Auth::user()->sector) }}</h3> --}}
        <h3>Daftar Komoditas Pertanian</h3>
        <a href="{{ route('pertanian.create') }}" class="btn btn-primary mb-3">+ Tambah Komoditas</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Komoditas</th>
                    <th>Satuan</th>
                    @auth
                        <th>Aksi</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($commodities as $commodity)
                    <tr>
                        <td>{{ $commodity->name }}</td>
                        <td>{{ $commodity->unit }}</td>
                        @auth
                            {{-- @if (Auth::user()->role === 'petugas_pertanian' || Auth::user()->role === 'admin') --}}
                                <td>
                                    <a href="{{ route('pertanian.edit', $commodity) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('pertanian.destroy', $commodity) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus?')"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            {{-- @endif --}}
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
