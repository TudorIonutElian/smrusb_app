<?php

/*
|--------------------------------------------------------------------------
| ADMIN API Routes
|--------------------------------------------------------------------------
*/

//Admin API Requests
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\JudeteController;
use App\Http\Controllers\RegiuniController;

Route::get('/admin/nomenclator/regiuni', [RegiuniController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/suspenda', [RegiuniController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/activeaza', [RegiuniController::class, 'activeaza'])->middleware('auth:sanctum');

Route::get('/admin/nomenclator/judete', [JudeteController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/judete/suspenda', [JudeteController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/judete/activeaza', [JudeteController::class, 'activeaza'])->middleware('auth:sanctum');


Route::get('/admin/institutii/creare_stat', [AdminController::class, 'institutiiCreareStat'])->middleware('auth:sanctum');


Route::get('/admin/solicitari_acces', [AdminController::class, 'solicitariAcces'])->middleware('auth:sanctum');
Route::post('/admin/aprobare_acces', [AdminController::class, 'aprobareAcces'])->middleware('auth:sanctum');
