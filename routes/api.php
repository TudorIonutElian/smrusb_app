<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InstitutiiController;
use App\Http\Controllers\LocalitatiController;
use App\Http\Controllers\RegiuniController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/data', [AdminController::class, 'loadData'])->middleware('auth:sanctum');
Route::get('/users', [AdminController::class, 'showUsers'])->middleware('auth:sanctum');
Route::get('/users/inregistrare/institutii', [InstitutiiController::class, 'preluareToateInstitutiile']);
Route::get('/users/pannel/{id}', [UserController::class, 'pannel']);


Route::post('/users/suspenda', [AdminController::class, 'suspendaCont'])->middleware('auth:sanctum');
Route::post('/users/activeaza', [AdminController::class, 'activeazaCont'])->middleware('auth:sanctum');
Route::post('/users/inregistrare', [AdminController::class, 'inregistrareCont']);

Route::post('/users/changePassword', [LoginController::class, 'checkPassword'])->middleware('auth:sanctum');


Route::get('/users/activare', [AdminController::class, 'showInactiveUsers']);
Route::get('/localitati', [LocalitatiController::class, 'index']);


//Admin API Requests
Route::get('/admin/nomenclator/regiuni', [RegiuniController::class, 'index'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/suspenda', [RegiuniController::class, 'suspenda'])->middleware('auth:sanctum');
Route::post('/admin/nomenclator/regiuni/activeaza', [RegiuniController::class, 'activeaza'])->middleware('auth:sanctum');





