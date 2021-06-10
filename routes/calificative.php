<?php


use App\Http\Controllers\CalificativeController;

Route::get('/calificative/preluare/{angajat_id}', [CalificativeController::class, 'preluareByID'])->middleware('auth:sanctum');
Route::get('/calificative/neaprobate/institutie/{institutie_id}', [CalificativeController::class, 'preluareNeaprobate'])->middleware('auth:sanctum');
Route::get('/calificative/neaprobate/institutie/{institutie_id}/specialist', [CalificativeController::class, 'preluareNeaprobateSpecialist'])->middleware('auth:sanctum');
Route::get('/calificative/contestatii/institutie/{institutie_id}/specialist', [CalificativeController::class, 'preluareContestatiiSpecialist'])->middleware('auth:sanctum');
Route::put('/calificative/aprobare', [CalificativeController::class, 'aprobareCalificativ'])->middleware('auth:sanctum');
Route::put('/calificative/aprobare_fara_contestatie', [CalificativeController::class, 'aprobareCalificativFaraContestatie'])->middleware('auth:sanctum');
Route::put('/calificative/contesta', [CalificativeController::class, 'contestaCalificativ'])->middleware('auth:sanctum');



