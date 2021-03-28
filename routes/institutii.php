<?php


use App\Http\Controllers\InstitutiiController;

Route::get('/institutii/all', [InstitutiiController::class, 'institutiiMutare']);
