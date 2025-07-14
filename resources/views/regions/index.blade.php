@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Wilayah</h3>
    <a href="{{ route('regions.create') }}" class="btn btn-primary mb-3">+ Tambah Wilayah</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Wilayah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $region)
                <tr>
                    <td>{{ $region->name }}</td>
                    <td>
                        <a href="{{ route('regions.edit', $region) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('regions.destroy', $region) }}" method="POST" style="display:inline">
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