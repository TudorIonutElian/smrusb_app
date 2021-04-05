<?php

use App\Http\Controllers\Pozitii\PozitiiController;

Route::get('/pozitii/{stat}/verificare/{pozitie}', [PozitiiController::class, 'verificarePozitie']);
Route::post('/pozitii/suplimentare', [PozitiiController::class, 'suplimentarePozitie']);
Route::get('/pozitii/{cod}/vacante', [PozitiiController::class, 'preluareVacante']);
Route::get('/pozitii/{cod}/vacante/stat', [PozitiiController::class, 'preluareVacanteStat']);
Route::get('/pozitii/{cod_institutie}/radiere', [PozitiiController::class, 'preluareRadiere']);
Route::post('/pozitii/radiere', [PozitiiController::class, 'pozitieRadiere']);
