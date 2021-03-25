<?php


use App\Http\Controllers\AngajatiController;

Route::post('/angajati/adaugare', [AngajatiController::class, 'adauga'])->middleware('auth:sanctum');
Route::get('/angajati/{id}', [AngajatiController::class, 'preluare'])->middleware('auth:sanctum');
