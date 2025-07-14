<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Region;
use Illuminate\Http\Request;

class CommoditieController extends Controller
{
    //
    public function index(Request $request)
    {
        $prices = Price::with(['commodity', 'region']);

        // Filter kategori komoditas (pertanian, perkebunan, perikanan)
        if ($request->filled('kategori')) {
            $prices->whereHas('commodity', function ($q) use ($request) {
                $q->where('category', $request->kategori);
            });
        }

        // Filter tipe harga (produsen, konsumen, pedagang besar)
        if ($request->filled('tipe_harga')) {
            $prices->where('price_type', $request->tipe_harga);
        }

        // Filter kabupaten
        if ($request->filled('kabupaten')) {
            $prices->where('region_id', $request->kabupaten);
        }

        $data = $prices->get();
        $regions = Region::all();

        return view('dashboard', compact('regions'));
    }
}
