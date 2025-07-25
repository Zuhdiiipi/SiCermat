<?php

namespace App\Http\Controllers;

use App\Models\Commoditie;
use App\Models\Price;
use App\Models\Region;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    //
    public function index()
    {
        $prices = Price::with(['commodity', 'region', 'user'])->latest()->get();
        return view('prices.index', compact('prices'));
    }

    public function create()
    {
        // $commodities = Commoditie::where('category', Auth::user()->sector)->get(); // 
        if (Auth::user()->role === 'admin') {
            $commodities = Commoditie::all(); // Admin bisa melihat semua
        } else {
            $commodities = Commoditie::where('category', Auth::user()->sector)->get();
        }

        $regions = Region::all();
        return view('prices.create', compact('commodities', 'regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities,id',
            'region_id' => 'required|exists:regions,id',
            'type_price' => 'required|in:produsen,konsumen,pedagang_besar',
            'date' => 'required|date',
            'price' => 'required|numeric|min:0'
        ]);

        // Ambil tanggal awal minggu (Senin)
        $weekStart = Carbon::parse($request->date)->startOfWeek(Carbon::MONDAY)->format('Y-m-d');

        Price::create([
            'commodity_id' => $request->commodity_id,
            'region_id' => $request->region_id,
            'user_id' => Auth::id(),
            'type_price' => $request->type_price,
            'date' => $weekStart,
            'price' => $request->price
        ]);

        return redirect()->route('prices.index')->with('success', 'Data harga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $price = Price::findOrFail($id);
        if (Auth::user()->role === 'admin') {
            $commodities = Commoditie::all(); // Admin bisa melihat semua
        } else {
        $commodities = Commoditie::where('category', Auth::user()->sector)->get();
        }
        $regions = Region::all();
        return view('prices.edit', compact('price', 'commodities', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities,id',
            'region_id' => 'required|exists:regions,id',
            'type_price' => 'required|in:produsen,konsumen,pedagang_besar',
            'date' => 'required|date',
            'price' => 'required|numeric|min:0'
        ]);

        $price = Price::findOrFail($id);
        $weekStart = Carbon::parse($request->date)->startOfWeek(Carbon::MONDAY)->format('Y-m-d');

        $price->update([
            'commodity_id' => $request->commodity_id,
            'region_id' => $request->region_id,
            'user_id' => Auth::id(),
            'type_price' => $request->type_price,
            'date' => $weekStart,
            'price' => $request->price
        ]);

        return redirect()->route('prices.index')->with('success', 'Data harga berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();
        return redirect()->route('prices.index')->with('success', 'Data harga berhasil dihapus.');
    }
}
