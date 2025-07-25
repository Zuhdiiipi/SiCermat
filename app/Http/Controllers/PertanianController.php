<?php

namespace App\Http\Controllers;

use App\Models\Commoditie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PertanianController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $commodities = Commoditie::where('category', 'pertanian')->get();
        return view('pertanian.index', compact('commodities'));
    }

    public function create()
    {
        return view('pertanian.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'     => 'required|string|unique:commodities,name',
    //         'unit'     => 'required|string',
    //         'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
    //     ]);
    //     $imageName = null;
    //     if ($request->hasFile('image')) {
    //         $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
    //         $request->image->storeAs('public/commodities', $imageName);
    //     }
    //     Commoditie::create([
    //         'name'     => $request->name,
    //         'unit'     => $request->unit,
    //         'category' => 'pertanian',
    //         'image'    => $imageName,
    //     ]);
    //     return redirect()->route('pertanian.index')->with('success', 'Komoditas berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|unique:commodities,name',
            'unit'     => 'required|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png', // max 2MB
        ]);
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $imagePath = $request->image->storeAs('commodities', $imageName, 'public');
            // $request->image->storeAs('public/commodities', $imageName);
        }
        Commoditie::create([
            'name'     => $request->name,
            'unit'     => $request->unit,
            'category' => 'pertanian',
            'image'    => $imagePath,
            // 'image'    => $imageName,
        ]);
        return redirect()->route('pertanian.index')->with('success', 'Komoditas berhasil ditambahkan.');
    }


    public function edit(Commoditie $commodity)
    {
        if ($commodity->category !== 'pertanian') {
            abort(403);
        }
        return view('pertanian.edit', compact('commodity'));
    }

    // public function update(Request $request, Commoditie $commodity)
    // {
    //     if ($commodity->category !== 'pertanian') {
    //         abort(403);
    //     }
    //     $request->validate([
    //         'name' => 'required|string|unique:commodities,name,' . $commodity->id,
    //         'unit' => 'required|string',
    //     ]);
    //     $commodity->update($request->only('name', 'unit'));
    //     return redirect()->route('pertanian.index')->with('success', 'Komoditas berhasil diperbarui.');
    // }
    public function update(Request $request, Commoditie $commodity)
    {
        if ($commodity->category !== 'pertanian') {
            abort(403);
        }
        $request->validate([
            'name' => 'required|string|unique:commodities,name,' . $commodity->id,
            'unit' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $data = $request->only('name', 'unit');
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            // if ($commodity->image && Storage::exists('public/commodities/' . $commodity->image)) {
            if ($commodity->image && file_exists(public_path('storage/' . $commodity->image))) {
                Storage::delete('public/commodities/' . $commodity->image);
            }
            // Simpan gambar baru
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->storeAs('commodities', $imageName, 'public');
            $data['image'] = 'commodities/' . $imageName;
        }
        $commodity->update($data);
        return redirect()->route('pertanian.index')->with('success', 'Komoditas berhasil diperbarui.');
    }


    public function destroy(Commoditie $commodity)
    {
        if ($commodity->category !== 'pertanian') {
            abort(403);
        }
        $commodity->delete();
        return redirect()->route('pertanian.index')->with('success', 'Komoditas berhasil dihapus.');
    }
}
