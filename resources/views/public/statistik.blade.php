@extends('layouts.app')

@section('title', 'Harga Komoditas - ' . $commodity->name)

@section('content')
    <div class="container my-4">
        <h4 class="mb-3">Daftar Harga: <strong>{{ $commodity->name }}</strong></h4>

        {{-- Filter --}}
        <form method="GET" action="{{ route('harga.show', [
            'id' => $commodity->id,
            'jenis_harga' => request('jenis_harga'),
            'kabupaten' => request('kabupaten'),
        ]) }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="jenis_harga" class="form-label">Jenis Harga</label>
                <select class="form-select" name="jenis_harga">
                    <option value="">Semua Jenis Harga</option>
                    <option value="produsen" {{ request('jenis_harga') == 'produsen' ? 'selected' : '' }}>Produsen</option>
                    <option value="konsumen" {{ request('jenis_harga') == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
                    <option value="pedagang_besar" {{ request('jenis_harga') == 'pedagang_besar' ? 'selected' : '' }}>
                        Pedagang Besar
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal"
                    value="{{ $tanggalAwal }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                    value="{{ $tanggalAkhir }}">
            </div>
            <div class="col-md-3">
                <label for="kabupaten" class="form-label">Wilayah</label>
                <select name="kabupaten" class="form-select">
                    <option value="">Semua Wilayah</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ request('kabupaten') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
            </div>
        </form>



        {{-- Tombol Export --}}
        <div class="mb-3">
            <a href="{{ route('harga.download.pdf', [
                'id' => $commodity->id,
                'jenis_harga' => request('jenis_harga'),
                'kabupaten' => request('kabupaten'),
            ]) }}"
                class="btn btn-danger">Download</a>
            {{-- ]) }}?jenis_harga={{ $jenisHarga }}&tanggal_awal={{ $tanggalAwal }}&tanggal_akhir={{ $tanggalAkhir }}"
                class="btn btn-danger">Download</a> --}}
        </div>

        <div class="table-responsive">
            <table id="tabelHarga" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Wilayah</th>
                        <th>Harga (Rp)</th>
                        <th>Status</th>
                        <th>Jenis Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pricesWithStatus as $item)
                        <tr>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['region'] }}</td>
                            <td>{{ number_format($item['price'], 2, ',', '.') }}</td>
                            <td>
                                @if ($item['status'] === 'naik')
                                    <span class="text-success">↑ Naik</span>
                                @elseif ($item['status'] === 'turun')
                                    <span class="text-danger">↓ Turun</span>
                                @elseif ($item['status'] === 'tetap')
                                    <span class="text-secondary">→ Tetap</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $item['type_price'])) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
