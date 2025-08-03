@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h3>Daftar Komoditas - {{ ucfirst(Auth::user()->sector) }}</h3> --}}
        <h3>Daftar Komoditas Perikanan</h3>
        <br>
        @auth
            @if (Auth::user()->role === 'petugas_perikanan' || Auth::user()->role === 'admin')
                <a href="{{ route('perikanan.create') }}" class="btn btn-primary mb-3">+ Tambah Komoditas</a>
            @endif
        @endauth
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Komoditas</th>
                    <th>Satuan</th>
                    @auth
                        @if (Auth::user()->role === 'petugas_perikanan' || Auth::user()->role === 'admin')
                            <th>Aksi</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($commodities as $commodity)
                    <tr>
                        <td>{{ $commodity->name }}</td>
                        <td>{{ $commodity->unit }}</td>
                        @auth
                            @if (Auth::user()->role === 'petugas_perikanan' || Auth::user()->role === 'admin')
                                <td>
                                    <a href="{{ route('perikanan.edit', $commodity) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('perikanan.destroy', $commodity) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus?')"
                                            class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
