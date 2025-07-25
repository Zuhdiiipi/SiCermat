<?php

namespace App\Http\Controllers;

use App\Models\Commoditie;
use App\Models\Region;
use Illuminate\Http\Request;

class PublicPriceController extends Controller
{
    //
    public function index(Request $request)
    {
        $kategori = $request->kategori; // pertanian, perikanan, perkebunan
        $jenisHarga = $request->jenis_harga; // produsen, konsumen, pedagang_besar
        $kabupaten = $request->kabupaten;

        $commodities = Commoditie::with(['prices' => function ($query) use ($jenisHarga) {
            $query->latest('date');
            if ($jenisHarga) {
                $query->where('type_price', $jenisHarga);
            }
        }, 'prices.region'])
            ->when($kategori, fn($q) => $q->where('category', $kategori))
            ->get();

        $regions = Region::all();

        return view('dashboard2', compact('commodities', 'regions', 'kategori', 'jenisHarga', 'kabupaten'));
    }
}
