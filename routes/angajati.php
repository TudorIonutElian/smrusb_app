<?php


use App\Http\Controllers\AngajatiController;

Route::post('/angajati/adaugare', [AngajatiController::class, 'adauga'])->middleware('auth:sanctum');
Route::get('/angajati/{id}', [AngajatiController::class, 'preluare'])->middleware('auth:sanctum');


Route::get('/angajati/mutare/{id}', [AngajatiController::class, 'preluareAngajatMutare'])->middleware('auth:sanctum');
Route::post('/angajati/mutare/{id}', [AngajatiController::class, 'mutareAngajat'])->middleware('auth:sanctum');

Route::get('/angajati/numire/{id}', [AngajatiController::class, 'preluareAngajatNumire'])->middleware('auth:sanctum');
Route::get('/angajati/numire/{id}/institutie', [AngajatiController::class, 'preluareInstitutie'])->middleware('auth:sanctum');
Route::post('/angajati/numire/{id}', [AngajatiController::class, 'numireAngajat'])->middleware('auth:sanctum');

Route::get('/angajati/fisaevidenta/{id}', [AngajatiController::class, 'fisaEvidenta'])->middleware('auth:sanctum');

