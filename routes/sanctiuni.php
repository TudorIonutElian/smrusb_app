<?php

use App\Http\Controllers\sanctiuniController;
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
Route::get('/sanctiuni/preluare', [SanctiuniController::class, 'preluareSanctiuni']);
Route::get('/sanctiuni/preluare/{id}', [SanctiuniController::class, 'preluareSanctiuniAngajat'])->middleware('auth:sanctum');
Route::post('/sanctiuni/adaugare', [SanctiuniController::class, 'adaugareSanctiune'])->middleware('auth:sanctum');
