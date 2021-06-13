<?php

use App\Http\Controllers\RecompenseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/recompense/preluare', [RecompenseController::class, 'preluareRecompense'])->middleware('auth:sanctum');
Route::get('/recompense/preluare/{id}', [RecompenseController::class, 'preluareRecompenseAngajat'])->middleware('auth:sanctum');
Route::post('/recompense/adaugare', [RecompenseController::class, 'adaugareRecompensa'])->middleware('auth:sanctum');





