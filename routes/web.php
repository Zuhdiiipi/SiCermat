<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommoditieController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

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

