<?php

/*
|--------------------------------------------------------------------------
| ADMIN API Routes
|--------------------------------------------------------------------------
*/

//Admin API Requests
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\InstitutiiController;
use App\Http\Controllers\JudeteController;
use App\Http\Controllers\LocalitatiController;
use App\Http\Controllers\RegiuniController;

Route::get('/admin/nomenclator/regiuni', [RegiuniController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/suspenda', [RegiuniController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/activeaza', [RegiuniController::class, 'activeaza'])->middleware('auth:sanctum');


Route::get('/admin/nomenclator/judet', [JudeteController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/judet/suspenda', [JudeteController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/judet/activeaza', [JudeteController::class, 'activeaza'])->middleware('auth:sanctum');

Route::get('/admin/nomenclator/localitati', [LocalitatiController::class, 'preluareToateLocalitatile'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/localitate/suspenda', [LocalitatiController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/localitate/activeaza', [LocalitatiController::class, 'activeaza'])->middleware('auth:sanctum');


Route::get('/admin/nomenclator/institutii', [InstitutiiController::class, 'preluareInstitutiiNomenclator'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/institutie/suspenda', [InstitutiiController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/institutie/activeaza', [InstitutiiController::class, 'activeaza'])->middleware('auth:sanctum');

Route::get('/admin/institutii/creare_stat', [AdminController::class, 'institutiiCreareStat'])->middleware('auth:sanctum');


Route::get('/admin/solicitari_acces', [AdminController::class, 'solicitariAcces'])->middleware('auth:sanctum');
Route::post('/admin/aprobare_acces', [AdminController::class, 'aprobareAcces'])->middleware('auth:sanctum');
