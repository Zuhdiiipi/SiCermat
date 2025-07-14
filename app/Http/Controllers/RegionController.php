<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    // Menampilkan daftar wilayah
    public function index()
    {
        $regions = Region::all(); // Assuming you have a Region model
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:regions,name',
        ]);

        Region::create($request->only('name'));
        return redirect()->route('regions.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|string|unique:regions,name,' . $region->id,
        ]);

        $region->update($request->only('name'));
        return redirect()->route('regions.index')->with('success', 'Wilayah berhasil diperbarui.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Wilayah berhasil dihapus.');
    }
}
