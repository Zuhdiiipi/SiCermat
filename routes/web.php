<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommoditieController;
use App\Http\Controllers\PerikananController;
use App\Http\Controllers\PertanianController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PublicPriceController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', [PublicPriceController::class, 'index'])->name('dashboard');
Route::get('/grafik-data', [PublicPriceController::class, 'grafikData']);

// Route::get('/', [CommoditieController::class, 'index'])->name('dashboard');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('regions', RegionController::class);
// });

Route::resource('/regions', RegionController::class);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Route::resource('/comodities', CommoditieController::class);

// Route::middleware(['auth'])->group(function () {
//     Route::resource('commodities', CommoditieController::class);
// });

// Route::middleware(['auth'])->group(function () {
//     // Tampilkan daftar komoditas
//     Route::get('/commodities', [CommoditieController::class, 'index'])->name('commodities.index');

//     // Tampilkan form tambah komoditas
//     Route::get('/commodities/create', [CommoditieController::class, 'create'])->name('commodities.create');

//     // Simpan komoditas baru
//     Route::post('/commodities', [CommoditieController::class, 'store'])->name('commodities.store');

//     // Tampilkan form edit
//     Route::get('/commodities/{commodity}/edit', [CommoditieController::class, 'edit'])->name('commodities.edit');

//     // Simpan perubahan
//     Route::put('/commodities/{commodity}', [CommoditieController::class, 'update'])->name('commodities.update');

//     // Hapus komoditas
//     Route::delete('/commodities/{commodity}', [CommoditieController::class, 'destroy'])->name('commodities.destroy');
// });

Route::get('/pertanian', [PertanianController::class, 'index'])->name('pertanian.index');
Route::get('/perikanan', [PerikananController::class, 'index'])->name('perikanan.index');
Route::middleware(['auth'])->group(function () {
    // pertanian
    Route::get('/pertanian/create', [PertanianController::class, 'create'])->name('pertanian.create');
    Route::post('/pertanian', [PertanianController::class, 'store'])->name('pertanian.store');
    Route::get('/pertanian/{commodity}/edit', [PertanianController::class, 'edit'])->name('pertanian.edit');
    Route::put('/pertanian/{commodity}', [PertanianController::class, 'update'])->name('pertanian.update');
    Route::delete('/pertanian/{commodity}', [PertanianController::class, 'destroy'])->name('pertanian.destroy');
    // perikanan
    Route::get('/perikanan/create', [PerikananController::class, 'create'])->name('perikanan.create');
    Route::post('/perikanan', [PerikananController::class, 'store'])->name('perikanan.store');
    Route::get('/perikanan/{commodity}/edit', [PerikananController::class, 'edit'])->name('perikanan.edit');
    Route::put('/perikanan/{commodity}', [PerikananController::class, 'update'])->name('perikanan.update');
    Route::delete('/perikanan/{commodity}', [PerikananController::class, 'destroy'])->name('perikanan.destroy');

    Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
    Route::get('/prices/create', [PriceController::class, 'create'])->name('prices.create');
    Route::post('/prices', [PriceController::class, 'store'])->name('prices.store');
    Route::get('/prices/{id}/edit', [PriceController::class, 'edit'])->name('prices.edit');
    Route::put('/prices/{id}', [PriceController::class, 'update'])->name('prices.update');
    Route::delete('/prices/{id}', [PriceController::class, 'destroy'])->name('prices.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
