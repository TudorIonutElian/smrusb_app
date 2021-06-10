<?php

use App\Http\Controllers\SalariiController;

Route::get('/salarizare/{cod}/generare', [SalariiController::class, 'generare'])->middleware('auth:sanctum');
Route::get('/salarizare/{institutie}/vizualizare/{dela}/{panala}', [SalariiController::class, 'vizualizare'])->middleware('auth:sanctum');
Route::get('/salarizare/datebanci/preluare', [SalariiController::class, 'preluareDateBanci'])->middleware('auth:sanctum');

Route::get('/salarizare/{institutie}/lunar/{luna}', [SalariiController::class, 'preluareSalariiLunar'])->middleware('auth:sanctum');
Route::get('/salarizare/{institutie}/trimestrial/{trimestru}', [SalariiController::class, 'preluareSalariiTrimestrial'])->middleware('auth:sanctum');
Route::get('/salarizare/{institutie}/semestrial/{semestru}', [SalariiController::class, 'preluareSalariiSemestrial'])->middleware('auth:sanctum');
Route::get('/salarizare/{institutie}/anual/{an}', [SalariiController::class, 'preluareSalariiAnual'])->middleware('auth:sanctum');
Route::get('/salarizare/{codnumericpersonal}/', [SalariiController::class, 'preluareSalariiByCNP'])->middleware('auth:sanctum');
Route::get('/salarizare/cass/neachitat/{institutie}/{startdate}/{enddate}', [SalariiController::class, 'preluareCassNeachitat'])->middleware('auth:sanctum');
Route::get('/salarizare/cass/achitat/{institutie}/{startdate}/{enddate}', [SalariiController::class, 'preluareCassAchitat'])->middleware('auth:sanctum');

Route::post('/salarizare/generare', [SalariiController::class, 'generareSalariu'])->middleware('auth:sanctum');
Route::post('/salarizare/achitare', [SalariiController::class, 'achitareSalariu'])->middleware('auth:sanctum');
Route::post('/salarizare/cass/neachitat/achitare', [SalariiController::class, 'achitareCass'])->middleware('auth:sanctum');
