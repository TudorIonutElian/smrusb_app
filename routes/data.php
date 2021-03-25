<?php

use App\Http\Controllers\DataController;

Route::get('/allUserData', [DataController::class, 'index']);
