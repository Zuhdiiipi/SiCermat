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

Route::get('/', [PublicPriceController::class, 'index'])->name('dashboard');
Route::get('/harga/komoditas/{id}', [PublicPriceController::class, 'show'])->name('harga.show');
Route::get('/harga/komoditas/{id}/download-pdf', [PublicPriceController::class, 'downloadPdf'])->name('harga.download.pdf');
Route::get('/harga/komoditas/{id}/export-csv', [PublicPriceController::class, 'exportCsv'])->name('harga.download.csv');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})
    ->middleware('auth')
    ->name('logout');

Route::get('/pertanian', [PertanianController::class, 'index'])->name('pertanian.index');
Route::get('/perikanan', [PerikananController::class, 'index'])->name('perikanan.index');
Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');

Route::middleware(['auth', 'adminpertanian'])->group(function () {
    // pertanian
    Route::get('/pertanian/create', [PertanianController::class, 'create'])->name('pertanian.create');
    Route::post('/pertanian', [PertanianController::class, 'store'])->name('pertanian.store');
    Route::get('/pertanian/{commodity}/edit', [PertanianController::class, 'edit'])->name('pertanian.edit');
    Route::put('/pertanian/{commodity}', [PertanianController::class, 'update'])->name('pertanian.update');
    Route::delete('/pertanian/{commodity}', [PertanianController::class, 'destroy'])->name('pertanian.destroy');
    // perikanan
});

Route::middleware(['auth', 'adminharga'])->group(function () {
    Route::get('/prices/create', [PriceController::class, 'create'])->name('prices.create');
    Route::post('/prices', [PriceController::class, 'store'])->name('prices.store');
    Route::get('/prices/{id}/edit', [PriceController::class, 'edit'])->name('prices.edit');
    Route::put('/prices/{id}', [PriceController::class, 'update'])->name('prices.update');
    Route::delete('/prices/{id}', [PriceController::class, 'destroy'])->name('prices.destroy');
});
Route::middleware(['auth', 'adminperikanan'])->group(function () {
    Route::get('/perikanan/create', [PerikananController::class, 'create'])->name('perikanan.create');
    Route::post('/perikanan', [PerikananController::class, 'store'])->name('perikanan.store');
    Route::get('/perikanan/{commodity}/edit', [PerikananController::class, 'edit'])->name('perikanan.edit');
    Route::put('/perikanan/{commodity}', [PerikananController::class, 'update'])->name('perikanan.update');
    Route::delete('/perikanan/{commodity}', [PerikananController::class, 'destroy'])->name('perikanan.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('/regions', RegionController::class);
});
