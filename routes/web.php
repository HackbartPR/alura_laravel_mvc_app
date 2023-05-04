<?php

use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('series.index');
});

Route::controller(SerieController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::view('/series/create', 'series.create')->name('series.create');
    Route::post('/series/store', 'store')->name('series.store');
});


