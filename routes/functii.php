<?php

use App\Http\Controllers\Functii\FunctiiController;


Route::get('/functii/preluare', [FunctiiController::class, 'all'])->middleware('auth:sanctum');
