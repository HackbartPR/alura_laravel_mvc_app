<?php

use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\SeasonController;
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
    Route::get('/series/create', 'create')->name('series.create');
    Route::post('/series/store', 'store')->name('series.store');
    Route::get('/series/{series}', 'show')->name('series.show');
    Route::get('/series/{series}/edit', 'edit')->name('series.edit');
    Route::put('/series/{series}', 'update')->name('series.update');
    Route::delete('/series/{series}', 'destroy')->name('series.destroy');
});

Route::get('/seasons/{season}/episodes', [EpisodeController::class, 'index'])->name('episodes.index');
