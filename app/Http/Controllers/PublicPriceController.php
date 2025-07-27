<?php
namespace App\Http\Controllers;
use App\Models\Commoditie;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Carbon;
class PublicPriceController extends Controller
{
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
            ->get();
        $regions = Region::all();
        return view('dashboard2', compact('commodities', 'regions', 'kategori', 'jenisHarga', 'kabupaten'));
    }
    public function grafikData(Request $request)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities,id',
            'region_id' => 'required|exists:regions,id',
            'type_price' => 'required|in:produsen,konsumen,pedagang_besar',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);
        $query = Price::where('commodity_id', $request->commodity_id)->where('region_id', $request->region_id)->where('type_price', $request->type_price)->orderBy('date');
        if ($request->start_date) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('date', '<=', $request->end_date);
        }
        $prices = $query->get();
        $labels = $prices->pluck('date')->map(fn($d) => Carbon::parse($d)->translatedFormat('d M'))->toArray();
        $values = $prices->pluck('price')->toArray();
        
        return response()->json([
            'labels' => $labels,
            'values' => $values,
        ]);
    }
}
