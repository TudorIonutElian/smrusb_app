<?php

use App\Http\Controllers\SituatiiController;

// Situatii incetari contracte de munca
Route::get('/situatii/incetaricontracte', [SituatiiController::class, 'incetariContracte'])->middleware('auth:sanctum');
Route::get('/situatii/incetaricontracte/{institutie}/{dela}/{panala}', [SituatiiController::class, 'incetariContracteFiltrat'])->middleware('auth:sanctum');
Route::get('/situatii/incetaricontracte/{institutie}/astazi', [SituatiiController::class, 'incetariAstazi'])->middleware('auth:sanctum');

// Situatii mutari personal
Route::get('/situatii/mutaripersonal/{institutie}/{dela}/{panala}', [SituatiiController::class, 'mutariPersonalFiltrat'])->middleware('auth:sanctum');
