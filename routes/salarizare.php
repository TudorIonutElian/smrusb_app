<?php

use App\Http\Controllers\SalariiController;

Route::get('/salarizare/{cod}/generare', [SalariiController::class, 'generare'])->middleware('auth:sanctum');
Route::get('/salarizare/{cod}/vizualizare', [SalariiController::class, 'vizualizare'])->middleware('auth:sanctum');
Route::get('/salarizare/datebanci/preluare', [SalariiController::class, 'preluareDateBanci'])->middleware('auth:sanctum');


Route::post('/salarizare/generare', [SalariiController::class, 'generareSalariu'])->middleware('auth:sanctum');
Route::post('/salarizare/achitare', [SalariiController::class, 'achitareSalariu'])->middleware('auth:sanctum');
