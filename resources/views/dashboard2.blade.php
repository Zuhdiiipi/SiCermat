@extends('layouts.app')
@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Harga Komoditas</h1>
        {{-- Filter --}}
        <form method="GET" action="{{ route('dashboard') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    <option value="pertanian" {{ request('kategori') == 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                    {{-- <option value="perkebunan" {{ request('kategori') == 'perkebunan' ? 'selected' : '' }}>Perkebunan</option> --}}
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
        {{-- Komoditas --}}
        @php $grouped = $commodities->groupBy('category'); @endphp
        @foreach ($grouped as $kategori => $komoditasGroup)
            <h4 class="mb-3 text-capitalize">{{ $kategori }}</h4>
            <div class="d-flex overflow-auto mb-5 pb-2 gap-3">
                @forelse ($komoditasGroup as $komoditas)
                    @php
                        $latestPrice =
                            $komoditas->prices->firstWhere('region_id', request('kabupaten')) ??
                            $komoditas->prices->first();
                        $previousPrice = $komoditas->prices
                            ->skip(1)
                            ->firstWhere('region_id', $latestPrice->region_id ?? null);
                        $status = '';
                        if ($latestPrice && $previousPrice) {
                            $status =
                                $latestPrice->price > $previousPrice->price
                                    ? 'naik'
                                    : ($latestPrice->price < $previousPrice->price
                                        ? 'turun'
                                        : 'stabil');
                        }
                    @endphp
                    <div class="card shadow-sm" style="min-width: 250px; max-width: 250px;">
                        @if ($komoditas->image && file_exists(public_path('storage/' . $komoditas->image)))
                            <img src="{{ asset('storage/' . $komoditas->image) }}" class="card-img-top"
                                alt="{{ $komoditas->name }}" style="height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-komoditas.png') }}" class="card-img-top" alt="Default Image"
                                style="height: 150px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $komoditas->name }}</h5>
                            @if ($latestPrice)
                                <p class="card-text mb-1">
                                    Harga: <strong>Rp {{ number_format($latestPrice->price, 0, ',', '.') }}</strong>
                                </p>
                                <p class="text-muted small mb-1">Jenis:
                                    {{ ucfirst(str_replace('_', ' ', $latestPrice->type_price)) }}</p>
                                <p class="text-muted small mb-0">Wilayah: {{ $latestPrice->region->name ?? '-' }}</p>
                                @php
                                    // Menentukan kelas background berdasarkan status
                                    $bgClass = '';
                                    $statusText = '';
                                    $iconClass = '';
                                    $statusIcon = '';
                                    if ($status === 'naik') {
                                        $bgClass = 'bg-danger';
                                        $statusText = 'Naik';
                                        $iconClass = 'bi-arrow-up';
                                        $statusIcon = 'fas fa-arrow-up';
                                    } elseif ($status === 'turun') {
                                        $bgClass = 'bg-success';
                                        $statusText = 'Turun';
                                        $iconClass = 'bi-arrow-down';
                                        $statusIcon = 'fas fa-arrow-down';
                                    } else {
                                        $bgClass = 'bg-secondary';
                                        $statusText = 'Stabil';
                                        $iconClass = 'fas fa-minus';
                                    }
                                @endphp
                                <p class="mb-1 text-white fw-bold {{ $bgClass }} p-2 rounded">
                                    Status:
                                    <i class="bi {{ $iconClass }}"></i> {{ $statusText }}
                                    <i class="{{ $statusIcon }}"></i>
                                </p>
                                {{-- Tombol Selengkapnya --}}
                                <button class="btn btn-primary btn-sm mt-2 selengkapnya-btn" data-id="{{ $komoditas->id }}"
                                    data-name="{{ $komoditas->name }}" {{-- data-region-id="{{ $latestPrice->region->id ?? '' }}" data-bs-toggle="modal" --}}
                                    data-region-id="{{ $latestPrice->region->id ?? $regions->first()->id }}"
                                    data-bs-toggle="modal" data-bs-target="#grafikModal">
                                    Selengkapnya
                                </button>
                            @else
                                <p class="text-muted">Belum ada data harga</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>Tidak ada komoditas dalam kategori ini.</p>
                @endforelse
            </div>
        @endforeach
    </div>
    {{-- Modal Grafik --}}
    <div class="modal fade" id="grafikModal" tabindex="-1" aria-labelledby="grafikModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Grafik Harga: <span id="modalTitle"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    {{-- Filter Grafik --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filterTypePrice">Jenis Harga</label>
                            <select id="filterTypePrice" class="form-select">
                                <option value="produsen">Produsen</option>
                                <option value="konsumen">Konsumen</option>
                                <option value="pedagang_besar">Pedagang Besar</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="startDate">Tanggal Awal</label>
                            <input type="date" id="startDate" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="endDate">Tanggal Akhir</label>
                            <input type="date" id="endDate" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button id="filterBtn" class="btn btn-primary w-100">Terapkan</button>
                        </div>
                    </div>
                    {{-- Chart --}}
                    <canvas id="chartHarga" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart;
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('grafikModal');
            const chartCanvas = document.getElementById('chartHarga');
            document.querySelectorAll('.selengkapnya-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const komoditasId = button.dataset.id;
                    const regionId = button.dataset.regionId;
                    const name = button.dataset.name;
                    document.getElementById('modalTitle').innerText = name;
                    // Default values
                    const typePrice = 'produsen';
                    document.getElementById('filterTypePrice').value = typePrice;
                    document.getElementById('startDate').value = '';
                    document.getElementById('endDate').value = '';
                    fetchChartData(komoditasId, regionId, typePrice);
                    // Bind filter button
                    document.getElementById('filterBtn').onclick = () => {
                        fetchChartData(
                            komoditasId,
                            regionId,
                            document.getElementById('filterTypePrice').value,
                            document.getElementById('startDate').value,
                            document.getElementById('endDate').value
                        );
                    };
                });
            });
            function fetchChartData(komoditasId, regionId, typePrice, startDate = '', endDate = '') {
                let url = `/grafik-data?commodity_id=${komoditasId}&region_id=${regionId}&type_price=${typePrice}`;
                if (startDate) url += `&start_date=${startDate}`;
                if (endDate) url += `&end_date=${endDate}`;
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        const labels = data.labels;
                        const prices = data.values;
                        if (chart) chart.destroy();
                        chart = new Chart(chartCanvas, {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Harga (Rp)',
                                    data: prices,
                                    borderColor: 'rgb(75, 192, 192)',
                                    tension: 0.3,
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: false
                                    }
                                }
                            }
                        });
                    });
            }
        });
    </script>
@endpush

