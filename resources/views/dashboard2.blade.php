@extends('layouts.app') {{-- atau sesuaikan dengan layout publikmu --}}

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Harga Komoditas</h1>
        {{-- Filter --}}
        <form method="GET" action="{{ route('dashboard') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="pertanian" {{ request('kategori') == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                    <option value="perikanan" {{ request('kategori') == 'perikanan' ? 'selected' : '' }}>Perikanan</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="jenis_harga" class="form-select">
                    <option value="">Semua Jenis Harga</option>
                    <option value="produsen" {{ request('jenis_harga') == 'produsen' ? 'selected' : '' }}>Produsen</option>
                    <option value="konsumen" {{ request('jenis_harga') == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
                    <option value="pedagang_besar" {{ request('jenis_harga') == 'pedagang_besar' ? 'selected' : '' }}>
                        Pedagang Besar</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="kabupaten" class="form-select">
                    <option value="">Semua Wilayah</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ request('kabupaten') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
            </div>
        </form>
        {{-- Komoditas Per Kategori --}}
        {{-- Komoditas Semua --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($commodities as $komoditas)
                
                @php
                    // Group berdasarkan kombinasi region + type_price
                    $groupedPrices = collect();
                    if ($kabupaten) {
                        $groupedPrices = $komoditas->prices->where('region_id', $kabupaten)->groupBy('type_price');
                    } else {
                        $groupedPrices = $komoditas->prices->groupBy(
                            fn($price) => $price->region_id . '_' . $price->type_price,
                        );
                    }
                @endphp
                @foreach ($groupedPrices as $group)
                    @php
                        // Ambil harga terbaru dalam grup
                        $price = collect($group)->sortByDesc('date')->first();
                        // Harga sebelumnya untuk status
                        $previousPrice = collect($group)->sortByDesc('date')->skip(1)->first();
                        $status = '';
                        if ($previousPrice) {
                            $status =
                                $price->price > $previousPrice->price
                                    ? 'naik'
                                    : ($price->price < $previousPrice->price
                                        ? 'turun'
                                        : 'stabil');
                        }
                        $bgClass = 'bg-secondary';
                        $statusText = ' Stabil ';
                        $iconClass = 'fas fa-minus';
                        if ($status === 'naik') {
                            $bgClass = 'bg-danger';
                            $statusText = ' Naik ';
                            $iconClass = 'fas fa-arrow-up';
                        } elseif ($status === 'turun') {
                            $bgClass = 'bg-success';
                            $statusText = ' Turun ';
                            $iconClass = 'fas fa-arrow-down';
                        }
                    @endphp
                    <div class="col">
                        <div class="card shadow-sm">
                            @if ($komoditas->image && file_exists(public_path('storage/' . $komoditas->image)))
                                <img src="{{ asset('storage/' . $komoditas->image) }}" class="card-img-top"
                                    alt="{{ $komoditas->name }}" style="height: 150px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/default-komoditas.png') }}" class="card-img-top"
                                    alt="Default Image" style="height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $komoditas->name }}</h5>
                                <p class="card-text mb-1">
                                    Harga: <strong>Rp {{ number_format($price->price, 0, ',', '.') }}</strong>
                                </p>
                                <p class="text-muted small mb-1">
                                    Jenis: {{ ucfirst(str_replace('_', ' ', $price->type_price)) }}
                                </p>
                                <p class="text-muted small mb-0">
                                    Wilayah: {{ $price->region->name ?? '-' }}
                                </p>
                                <p class="mb-1 text-white fw-bold {{ $bgClass }} p-2 rounded">
                                    Status: {{ $statusText }} <i class="{{ $iconClass }}"></i>
                                </p>
                                <a href="{{ route('harga.show', [
                                    'id' => $komoditas->id,
                                    'jenis_harga' => request('jenis_harga'),
                                     'kabupaten' => request('kabupaten'),
                                    // 'kabupaten' => $region->id,
                                ]) }}"
                                    class="btn btn-outline-primary btn-sm w-100 mt-2">
                                    Lihat Statistik
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @empty
                <p>Tidak ada komoditas ditemukan.</p>
            @endforelse
        </div>
    </div>
@endsection
