<?php

/*
|--------------------------------------------------------------------------
| Localitati API Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\LocalitatiController;

Route::get('/localitati', [LocalitatiController::class, 'index']);
