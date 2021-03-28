<?php

use App\Http\Controllers\Pozitii\PozitiiController;
use App\Http\Controllers\StatOrganizare\StatOrganizareController;
use App\Models\StatOrganizare;

Route::get('/stat/{id}/pozitii', [PozitiiController::class, 'preluarePozitiiStat']);
Route::get('/stat/{id}/verificare', [StatOrganizareController::class, 'verificareStat'])->middleware('auth:sanctum');


Route::post('/stat/{id}/creare', [StatOrganizareController::class, 'creareStat'])->middleware('auth:sanctum');
