<?php
namespace App\Http\Controllers;
use App\Models\Commoditie;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Price;
use Mpdf\Mpdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class PublicPriceController extends Controller
{
    // public function index(Request $request)
    // {
    //     $kategori = $request->kategori;
    //     $jenisHarga = $request->jenis_harga;
    //     $kabupaten = $request->kabupaten;
    //     $commodities = Commoditie::with([
    //         'prices' => function ($query) use ($jenisHarga) {
    //             $query->latest('date');
    //             if ($jenisHarga) {
    //                 $query->where('type_price', $jenisHarga);
    //             }
    //         },
    //         'prices.region',
    //     ])
    //         ->when($kategori, fn($q) => $q->where('category', $kategori))
    //         ->get();
    //     $regions = Region::all();
    //     return view('dashboard2', compact('commodities', 'regions', 'kategori', 'jenisHarga', 'kabupaten'));
    // }

    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $jenisHarga = $request->jenis_harga;
        $kabupaten = $request->kabupaten;

        $commodities = Commoditie::with([
            'prices' => function ($query) use ($jenisHarga) {
                $query->latest('date');
                if ($jenisHarga) {
                    $query->where('type_price', $jenisHarga);
                }
            },
            'prices.region',
        ])
            ->when($kategori, fn($q) => $q->where('category', $kategori))
            ->get()
            ->filter(function ($komoditas) use ($kabupaten) {
                // Komoditas hanya boleh tampil jika memiliki setidaknya 1 harga
                if ($kabupaten) {
                    return $komoditas->prices->where('region_id', $kabupaten)->isNotEmpty();
                } else {
                    return $komoditas->prices->isNotEmpty(); // harga dari wilayah manapun
                }
            });

        $regions = Region::all();

        return view('dashboard2', compact('commodities', 'regions', 'kategori', 'jenisHarga', 'kabupaten'));
    }

    public function show($id, Request $request)
    {
        $commodity = Commoditie::findOrFail($id);

        $jenisHarga = $request->jenis_harga; // Default jika tidak ada filter
        $kabupaten = $request->kabupaten; // Dapatkan kabupaten yang dipilih
        $tanggalAwal = $request->tanggal_awal; // Dapatkan tanggal awal dari request
        $tanggalAkhir = $request->tanggal_akhir; // Dapatkan tanggal akhir dari request

        $prices = Price::with(['region', 'user'])
            ->where('commodity_id', $id)
            ->when($jenisHarga, function ($query) use ($jenisHarga) {
                // Jika jenis_harga dipilih, filter berdasarkan jenis harga
                $query->where('type_price', $jenisHarga);
            })
            ->when($kabupaten, function ($query) use ($kabupaten) {
                // Filter berdasarkan wilayah jika ada kabupaten
                $query->where('region_id', $kabupaten);
            })
            ->orderBy('date') // Pastikan harga diurutkan berdasarkan tanggal
            ->get();

        // Ambil semua wilayah untuk filter
        $regions = Region::all();

        // Hitung status naik/turun berdasarkan harga sebelumnya per wilayah
        $pricesWithStatus = [];
        $previousPrices = [];

        foreach ($prices as $price) {
            $regionId = $price->region_id;

            $status = null;
            if (isset($previousPrices[$regionId])) {
                $prev = $previousPrices[$regionId];
                if ($price->price > $prev) {
                    $status = 'naik';
                } elseif ($price->price < $prev) {
                    $status = 'turun';
                } else {
                    $status = 'tetap';
                }
            }

            $pricesWithStatus[] = [
                'date' => $price->date->format('Y-m-d'),
                'region' => $price->region->name,
                'price' => $price->price,
                'status' => $status,
                'type_price' => $price->type_price,
            ];

            $previousPrices[$regionId] = $price->price;
        }

        // Return view dengan variabel tambahan $regions
        return view('public.statistik', compact('commodity', 'jenisHarga', 'kabupaten', 'tanggalAwal', 'tanggalAkhir', 'pricesWithStatus', 'regions'));
    }
    public function downloadPdf(Request $request, $id)
    {
        $commodity = Commoditie::findOrFail($id);
        $jenisHarga = $request->jenis_harga; // Default jika tidak ada filter
        $tanggalAwal = $request->tanggal_awal ?? now()->subDays(30)->toDateString();
        $tanggalAkhir = $request->tanggal_akhir ?? now()->toDateString();
        $kabupaten = $request->kabupaten; // Ambil kabupaten yang dipilih untuk filter

        // Query harga berdasarkan komoditas, wilayah (kabupaten), dan jenis harga
        $prices = Price::with('region')
            ->where('commodity_id', $id)
            ->when($jenisHarga, function ($query) use ($jenisHarga) {
                // Jika jenis_harga dipilih, filter berdasarkan jenis harga
                $query->where('type_price', $jenisHarga);
            })
            ->whereBetween('date', [$tanggalAwal, $tanggalAkhir])
            ->when($kabupaten, function ($query) use ($kabupaten) {
                // Pastikan filter berdasarkan wilayah
                $query->where('region_id', $kabupaten);
            })
            ->orderBy('region_id')
            ->orderBy('date')
            ->get();

        // Hitung status naik/turun/tetap
        $regions = Region::all();

        // $pricesWithStatus = [];
        // $previousPrices = [];
        // foreach ($prices as $price) {
        //     $regionId = $price->region_id;

        //     $status = null;
        //     if (isset($previousPrices[$regionId])) {
        //         $prev = $previousPrices[$regionId];
        //         if ($price->price > $prev) {
        //             $status = 'naik';
        //         } elseif ($price->price < $prev) {
        //             $status = 'turun';
        //         } else {
        //             $status = 'tetap';
        //         }
        //     }

        //     $pricesWithStatus[] = [
        //         'date' => $price->date->format('Y-m-d'),
        //         'region' => $price->region->name,
        //         'price' => $price->price,
        //         'status' => $status,
        //         'type_price' => $price->type_price,
        //     ];
        //     dd($pricesWithStatus);
        // }

        $pricesWithStatus = [];
        $previousPrices = []; // Menyimpan harga sebelumnya untuk tiap wilayah

        foreach ($prices as $price) {
            $regionId = $price->region_id;

            // Tentukan status berdasarkan perbandingan dengan harga sebelumnya
            $status = '-'; // Status default untuk harga pertama kali

            if (isset($previousPrices[$regionId])) {
                // Jika ada harga sebelumnya untuk wilayah ini
                $previous = $previousPrices[$regionId];
                if ($price->price > $previous->price) {
                    $status = 'naik';
                } elseif ($price->price < $previous->price) {
                    $status = 'turun';
                } else {
                    $status = 'tetap';
                }
            }

            // Tambahkan data harga beserta statusnya ke array
            $pricesWithStatus[] = [
                'date' => $price->date->format('Y-m-d'),
                'region' => $price->region->name,
                'price' => $price->price,
                'status' => $status,
                'type_price' => $price->type_price,
            ];

            // Set harga sebelumnya untuk wilayah ini
            $previousPrices[$regionId] = $price;
        }

        // Render PDF dengan harga yang telah difilter sesuai wilayah
        $html = view('public.pdf', compact('commodity', 'jenisHarga', 'tanggalAwal', 'tanggalAkhir', 'pricesWithStatus', 'kabupaten', 'regions'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output("harga_{$commodity->name}.pdf", 'D');
    }
}

// $previous = Price::where('commodity_id', $price->commodity_id)
//     ->where('region_id', $price->region_id)
//     ->where('type_price', $price->type_price)
//     ->where('date', '<', $price->date)
//     ->orderBy('date', 'desc')
//     ->first();

// $status = '-';
// if ($previous) {
//     if ($price->price > $previous->price) {
//         $status = 'naik';
//     } elseif ($price->price < $previous->price) {
//         $status = 'turun';
//     } else {
//         $status = 'tetap';
//     }
// }
