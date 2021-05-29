<?php

use App\Http\Controllers\DataController;

Route::get('/allUserData', [DataController::class, 'index']);
Route::get('/judete', [DataController::class, 'getJudete']);
Route::get('/user/incetarecontract/preluare', [DataController::class, 'preluareMotiveIncetareContract']);
