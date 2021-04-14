<?php

use App\Http\Controllers\PontajController;

Route::post('/pontaj/creare', [PontajController::class, 'creare'])->middleware('auth:sanctum');
Route::get('/pontaj/preluare/{id}', [PontajController::class, 'preluare'])->middleware('auth:sanctum');
Route::get('/pontaj/preluare/institutie/{id}', [PontajController::class, 'preluarePontajInstitutie'])->middleware('auth:sanctum');
