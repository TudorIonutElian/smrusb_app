<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\InstitutiiController;
use App\Http\Controllers\StatOrganizare\StatOrganizareController;
use App\Http\Controllers\UserController;

Route::get('/users', [AdminController::class, 'showUsers'])->middleware('auth:sanctum');
Route::get('/users/inregistrare/institutii', [InstitutiiController::class, 'preluareToateInstitutiile']);
Route::get('/users/pannel/{id}', [UserController::class, 'pannel']);
Route::post('/users/suspenda', [AdminController::class, 'suspendaCont'])->middleware('auth:sanctum');
Route::post('/users/activeaza', [AdminController::class, 'activeazaCont'])->middleware('auth:sanctum');
Route::post('/users/inregistrare', [AdminController::class, 'inregistrareCont']);
Route::post('/users/changePassword', [LoginController::class, 'checkPassword'])->middleware('auth:sanctum');
Route::get('/users/activare', [AdminController::class, 'showInactiveUsers']);

Route::get('/users/acces/{id}', [UserController::class, 'acces'])->middleware('auth:sanctum');
Route::post('/users/acces/{id}', [UserController::class, 'adaugaAcces'])->middleware('auth:sanctum');
Route::get('/users/institutii/acces/{id}', [UserController::class, 'accesInstitutii']);

Route::get('/users/institutii/stat/{id}', [StatOrganizareController::class, 'accesStat']);
Route::get('/users/institutii/{id}/stat/', [StatOrganizareController::class, 'preluareStat']);


Route::get('/users/angajati/aprobare/{user_id}', [UserController::class, 'aprobareConturiAngajat'])->middleware('auth:sanctum');
Route::post('/users/angajataccount/{angajat_id}/aprobare', [UserController::class, 'aprobareContRUAngajat'])->middleware('auth:sanctum');
