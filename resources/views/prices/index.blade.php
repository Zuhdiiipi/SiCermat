@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class="page-title">Daftar Harga Komoditas</h4>
    <a href="{{ route('prices.create') }}" class="btn btn-primary btn-sm float-right">+ Tambah Harga</a>
</div>

<div class="table-responsive mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Komoditas</th>
                <th>Wilayah</th>
                <th>Tanggal (Mingguan)</th>
                <th>Jenis Harga</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prices as $price)
            <tr>
                <td>{{ $price->commodity->name }}</td>
                <td>{{ $price->region->name }}</td>
                <td>{{ \Carbon\Carbon::parse($price->date)->format('d M Y') }}</td>
                <td>{{ ucfirst($price->type_price) }}</td>
                <td>Rp {{ number_format($price->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('prices.edit', $price->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('prices.destroy', $price->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
