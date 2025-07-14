@extends('layouts.app')

@section('content')
 <div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('dashboard') }}">
            <div class="row">
                {{-- Filter Komoditas --}}
                <div class="col-md-4 mb-2">
                    <label for="kategori" class="form-label fw-semibold">Kategori Komoditas</label>
                    <select name="kategori" id="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="pertanian" {{ request('kategori') == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                        <option value="perkebunan" {{ request('kategori') == 'perkebunan' ? 'selected' : '' }}>Perkebunan</option>
                        <option value="perikanan" {{ request('kategori') == 'perikanan' ? 'selected' : '' }}>Perikanan</option>
                    </select>
                </div>

                {{-- Filter Harga --}}
                <div class="col-md-4 mb-2">
                    <label for="tipe_harga" class="form-label fw-semibold">Tipe Harga</label>
                    <select name="tipe_harga" id="tipe_harga" class="form-select">
                        <option value="">Semua Tipe</option>
                        <option value="produsen" {{ request('tipe_harga') == 'produsen' ? 'selected' : '' }}>Produsen</option>
                        <option value="konsumen" {{ request('tipe_harga') == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
                        <option value="pedagang_besar" {{ request('tipe_harga') == 'pedagang_besar' ? 'selected' : '' }}>Pedagang Besar</option>
                    </select>
                </div>

                {{-- Filter Kabupaten --}}
                <div class="col-md-4 mb-2">
                    <label for="kabupaten" class="form-label fw-semibold">Kabupaten</label>
                    <select name="kabupaten" id="kabupaten" class="form-select">
                        <option value="">Semua Kabupaten</option>
                        {{-- @foreach ($regions as $region)
                            <option value="{{ $region->id }}" {{ request('kabupaten') == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                {{-- Tombol Filter --}}
                <div class="col-md-12 mt-3 text-end">
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection