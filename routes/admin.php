<?php

/*
|--------------------------------------------------------------------------
| ADMIN API Routes
|--------------------------------------------------------------------------
*/

//Admin API Requests
use App\Http\Controllers\RegiuniController;

Route::get('/admin/nomenclator/regiuni', [RegiuniController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/suspenda', [RegiuniController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/activeaza', [RegiuniController::class, 'activeaza'])->middleware('auth:sanctum');
