<?php

use App\Http\Controllers\Cuprins\CuprinsController;

Route::get('/cuprins/{institutie}/preluare', [CuprinsController::class, 'preluare']);
