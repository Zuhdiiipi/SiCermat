@extends('layouts.app')

@section('content')
<h4 class="page-title">Edit Data Harga</h4>

<form action="{{ route('prices.update', $price->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Komoditas</label>
        <select name="commodity_id" class="form-control" required>
            @foreach($commodities as $commodity)
                <option value="{{ $commodity->id }}" {{ $commodity->id == $price->commodity_id ? 'selected' : '' }}>
                    {{ $commodity->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Wilayah</label>
        <select name="region_id" class="form-control" required>
            @foreach($regions as $region)
                <option value="{{ $region->id }}" {{ $region->id == $price->region_id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Tanggal (Salah satu tanggal dalam minggu)</label>
        <input type="date" name="date" value="{{ $price->date->format('Y-m-d') }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Jenis Harga</label>
        <select name="type_price" class="form-control" required>
            <option value="produsen" {{ $price->type_price == 'produsen' ? 'selected' : '' }}>Produsen</option>
            <option value="konsumen" {{ $price->type_price == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
            <option value="pedagang_besar" {{ $price->type_price == 'pedagang_besar' ? 'selected' : '' }}>Pedagang Besar</option>
        </select>
    </div>

    <div class="form-group">
        <label>Harga (Rp)</label>
        <input type="number" name="price" class="form-control" value="{{ $price->price }}" required>
    </div>

    <button class="btn btn-success">Update</button>
</form>
@endsection
