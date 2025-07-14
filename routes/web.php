<?php

use App\Http\Controllers\CommoditieController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/', [CommoditieController::class, 'index'])->name('dashboard');