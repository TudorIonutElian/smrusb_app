<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LocalitatiController;
use App\Models\Judet;
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


Route::post('/users/suspenda', [AdminController::class, 'suspendaCont'])->middleware('auth:sanctum');
Route::post('/users/activeaza', [AdminController::class, 'activeazaCont'])->middleware('auth:sanctum');
Route::get('/users/activare', [AdminController::class, 'showInactiveUsers']);

Route::get('/localitati', [LocalitatiController::class, 'index']);





