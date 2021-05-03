<?php

use App\Http\Controllers\SituatiiController;

Route::get('/situatii/incetaricontracte', [SituatiiController::class, 'incetariContracte'])->middleware('auth:sanctum');
Route::get('/situatii/incetaricontracte/{institutie}/{dela}/{panala}', [SituatiiController::class, 'incetariContracteFiltrat'])->middleware('auth:sanctum');
Route::get('/situatii/incetaricontracte/astazi', [SituatiiController::class, 'incetariAstazi'])->middleware('auth:sanctum');
