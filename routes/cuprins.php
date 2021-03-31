<?php

use App\Http\Controllers\Cuprins\CuprinsController;

Route::get('/cuprins/{institutie}/preluare', [CuprinsController::class, 'preluare']);
Route::post('/cuprins/creare', [CuprinsController::class, 'creare'])->middleware('auth:sanctum');
