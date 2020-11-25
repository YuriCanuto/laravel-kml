<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KmlController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('kml.index')->get('/kml', [KmlController::class, 'index']);
Route::name('kml.create')->post('/kml', [KmlController::class, 'store']);

Route::name('kml.create')->get('/teste', [KmlController::class, 'makeFile']);
