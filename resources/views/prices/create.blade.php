@extends('layouts.app')

@section('content')
<h4 class="page-title">Tambah Data Harga Komoditas</h4>

<form action="{{ route('prices.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Komoditas</label>
        <select name="commodity_id" class="form-control" required>
            @foreach($commodities as $commodity)
                <option value="{{ $commodity->id }}">{{ $commodity->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Wilayah</label>
        <select name="region_id" class="form-control" required>
            @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Tanggal (Salah satu tanggal dalam minggu)</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Harga</label>
        <select name="type_price" class="form-control" required>
            <option value="produsen">Produsen</option>
            <option value="konsumen">Konsumen</option>
            <option value="pedagang_besar">Pedagang Besar</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection
