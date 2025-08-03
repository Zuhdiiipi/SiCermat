@extends('layouts.app')

@section('content')
<div class="page-header">
    <h4 class="page-title">Grafik Harga: {{ $commodity->name }} - {{ $region->name }}</h4>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route('grafik.show', [$commodity->id, $region->id]) }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="jenis_harga" class="form-label">Jenis Harga</label>
                <select name="jenis_harga" id="jenis_harga" class="form-control">
                    <option value="produsen" {{ $jenisHarga == 'produsen' ? 'selected' : '' }}>Produsen</option>
                    <option value="konsumen" {{ $jenisHarga == 'konsumen' ? 'selected' : '' }}>Konsumen</option>
                    <option value="pedagang_besar" {{ $jenisHarga == 'pedagang_besar' ? 'selected' : '' }}>Pedagang Besar</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ $tanggalAwal }}">
            </div>
            <div class="col-md-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ $tanggalAkhir }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
            </div>
        </form>

        @if($data->isEmpty())
            <div class="alert alert-warning text-center">
                Data tidak tersedia untuk rentang waktu dan jenis harga yang dipilih.
            </div>
        @else
            <div class="chart-container" style="position: relative; height:300px; width:100%">
                <canvas id="hargaChart"></canvas>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if(!$data->isEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('hargaChart').getContext('2d');

    const hargaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Harga (Rp)',
                data: {!! json_encode($data) !!},
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointBackgroundColor: '#4e73df',
                pointBorderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
@endif
@endpush
