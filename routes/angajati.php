<?php


use App\Http\Controllers\AngajatiController;
use App\Http\Controllers\DatePlataController;

Route::post('/angajati/adaugare', [AngajatiController::class, 'adauga'])->middleware('auth:sanctum');
Route::post('/angajati/mutare/{id}', [AngajatiController::class, 'mutareAngajat'])->middleware('auth:sanctum');
Route::post('/angajati/numire/{id}', [AngajatiController::class, 'numireAngajat'])->middleware('auth:sanctum');
Route::post('/angajati/incetarecontract', [AngajatiController::class, 'angajatIncetareContract'])->middleware('auth:sanctum');
Route::post('/angajati/datebancare', [DatePlataController::class, 'adaugaDateBancare'])->middleware('auth:sanctum');
Route::post('/angajati/calificative/adaugare', [AngajatiController::class, 'adaugareCalificativ'])->middleware('auth:sanctum');



Route::get('/angajati/{id}', [AngajatiController::class, 'preluare'])->middleware('auth:sanctum');
Route::get('/angajati/incetare{user_id}', [AngajatiController::class, 'angajatiPreluareIncetare'])->middleware('auth:sanctum');
Route::get('/angajati/mutare/{id}', [AngajatiController::class, 'preluareAngajatMutare'])->middleware('auth:sanctum');
Route::get('/angajati/numire/{id}', [AngajatiController::class, 'preluareAngajatNumire'])->middleware('auth:sanctum');
Route::get('/angajati/numire/{id}/institutie', [AngajatiController::class, 'preluareInstitutie'])->middleware('auth:sanctum');
Route::get('/angajati/fisaevidenta/{id}', [AngajatiController::class, 'fisaEvidenta'])->middleware('auth:sanctum');
Route::get('/angajati/{id}/preluaredatecalificativ', [AngajatiController::class, 'preluaredatecalificativ'])->middleware('auth:sanctum');
Route::get('/angajati/calificative/anprecedent/{an}/{institutie}', [AngajatiController::class, 'preluareAnPrecedent'])->middleware('auth:sanctum');
Route::get('/angajati/datebancare/{id}', [DatePlataController::class, 'preluareDateBancare'])->middleware('auth:sanctum');

