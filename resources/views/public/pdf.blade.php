<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Harga Komoditas - {{ $commodity->name }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h3>Daftar Harga Komoditas: {{ $commodity->name }}</h3>
    <p>Jenis Harga: {{ ucfirst($jenisHarga) }} | Tanggal: {{ $tanggalAwal }} - {{ $tanggalAkhir }}</p>

    {{-- Menampilkan wilayah yang dipilih --}}
    @if ($kabupaten)
        <p>Wilayah: {{ $regions->firstWhere('id', $kabupaten)->name ?? 'Semua Wilayah' }}</p>
    @else
        <p>Wilayah: Semua Wilayah</p>
    @endif

    <table>
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
                    {{-- <td>{{ $item['region'] }}</td> --}}
                    <td>{{ $item['region']}}</td>
                    <td>{{ number_format($item['price'], 2, ',', '.') }}</td>
                    <td>
                        @if ($item['status'] === 'naik')
                            ↑ Naik
                        @elseif ($item['status'] === 'turun')
                            ↓ Turun
                        @elseif ($item['status'] === 'tetap')
                            → Tetap
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ ucfirst(str_replace('_', ' ', $item['type_price'])) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
