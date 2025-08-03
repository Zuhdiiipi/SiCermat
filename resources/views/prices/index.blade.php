@extends('layouts.app')

@section('content')
    {{-- <div class="page-header">
    <h4 class="page-title">Daftar Harga Komoditas</h4>
    <a href="{{ route('prices.create') }}" class="btn btn-primary btn-sm float-right">+ Tambah Harga</a>
</div> --}}
    <div class="container">
        <h3>Daftar Harga Komoditas</h3>
        <br>
        @auth
            @if (Auth::user()->role === 'petugas_perikanan' ||
                    Auth::user()->role === 'petugas_pertanian' ||
                    Auth::user()->role === 'admin')
                <a href="{{ route('prices.create') }}" class="btn btn-primary mb-3">+ Tambah Harga</a>
            @endif
        @endauth


        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Komoditas</th>
                        <th>Wilayah</th>
                        <th>Tanggal</th>
                        <th>Jenis Harga</th>
                        <th>Harga</th>
                        @auth
                            <th>Aksi</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prices as $price)
                        <tr>
                            <td>{{ $price->commodity->name }}</td>
                            <td>{{ $price->region->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($price->date)->format('d M Y') }}</td>
                            <td>{{ ucfirst($price->type_price) }}</td>
                            <td>Rp {{ number_format($price->price, 0, ',', '.') }}</td>
                            @auth
                                <td>
                                    <a href="{{ route('prices.edit', $price->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('prices.destroy', $price->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            @endauth

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
