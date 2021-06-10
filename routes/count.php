<?php

use App\Http\Controllers\CountController;

Route::get('/count/{id}/salarii', [CountController::class, 'countSalarii'])->middleware('auth:sanctum');
Route::get('/count/{id}/pontaje', [CountController::class, 'countPontaje'])->middleware('auth:sanctum');
Route::get('/count/{id}/calificative', [CountController::class, 'countCalificative'])->middleware('auth:sanctum');
