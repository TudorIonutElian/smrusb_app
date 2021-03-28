<?php

use App\Http\Controllers\JudeteController;

Route::get('/judete/all', [JudeteController::class, 'index']);
