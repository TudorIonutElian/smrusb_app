<?php

/*
|--------------------------------------------------------------------------
| Localitati API Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\LocalitatiController;

Route::get('/localitati', [LocalitatiController::class, 'index']);
Route::get('/localitati/{judet_id}', [LocalitatiController::class, 'preluareLocalitatiByID']);
Route::get('/localitati/adrese', [LocalitatiController::class, 'adrese']);
