<?php

use App\Http\Controllers\Pozitii\PozitiiController;

Route::get('/pozitii/{stat}/verificare/{pozitie}', [PozitiiController::class, 'verificarePozitie']);
