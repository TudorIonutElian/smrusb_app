<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\RecompenseController;

Route::get('/allUserData', [DataController::class, 'index']);
Route::get('/judete', [DataController::class, 'getJudete']);
Route::get('/user/incetarecontract/preluare', [DataController::class, 'preluareMotiveIncetareContract']);
Route::get('/recompense/all', [RecompenseController::class, 'preluare']);
