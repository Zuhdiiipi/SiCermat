<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        // Ambil semua pengguna, kecuali yang memiliki role 'admin'
        $users = User::where('role', '!=', 'admin')->get();
        return view('users.index', compact('users'));
    }


    // Form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:petugas_pertanian,petugas_perikanan',
            'sector'   => 'required|in:pertanian,perikanan',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'sector'   => $request->sector,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Akun petugas berhasil dibuat.');
    }

    // Form edit user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Simpan update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:petugas_pertanian,petugas_perikanan',
            'sector'   => 'required|in:pertanian,perikanan',
        ]);

        $user->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'role'   => $request->role,
            'sector' => $request->sector,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun berhasil dihapus.');
    }

}
