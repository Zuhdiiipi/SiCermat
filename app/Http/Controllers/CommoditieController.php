<?php

namespace App\Http\Controllers;

use App\Models\Commoditie;
use App\Models\Price;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommoditieController extends Controller
{
    //
    // public function index()
    // {
    //     $user = Auth::user();
    //     $commodities = Commoditie::where('category', $user->sector)->get();
    //     return view('commodities.index', compact('commodities'));
    // }

    public function create()
    {
        return view('commodities.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'     => 'required|string|unique:commodities,name',
    //         'unit'     => 'required|string',
    //     ]);

    //     Commoditie::create([
    //         'name'     => $request->name,
    //         'unit'     => $request->unit,
    //         'category' => Auth::user()->sector,
    //     ]);

    //     return redirect()->route('commodities.index')->with('success', 'Komoditas berhasil ditambahkan.');
    // }

    public function edit(Commoditie $commodity)
    {
        if ($commodity->category !== Auth::user()->sector) {
            abort(403);
        }
        return view('commodities.edit', compact('commodity'));
    }

    // public function update(Request $request, Commoditie $commodity)
    // {
    //     if ($commodity->category !== Auth::user()->sector) {
    //         abort(403);
    //     }

    //     $request->validate([
    //         'name' => 'required|string|unique:commodities,name,' . $commodity->id,
    //         'unit' => 'required|string',
    //     ]);

    //     $commodity->update($request->only('name', 'unit'));

    //     return redirect()->route('commodities.index')->with('success', 'Komoditas berhasil diperbarui.');
    // }

    // public function destroy(Commoditie $commodity)
    // {
    //     if ($commodity->category !== Auth::user()->sector) {
    //         abort(403);
    //     }

    //     $commodity->delete();
    //     return redirect()->route('commodities.index')->with('success', 'Komoditas berhasil dihapus.');
    // }
}
