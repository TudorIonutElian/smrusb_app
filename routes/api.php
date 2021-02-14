<?php

use App\Http\Controllers\Admin\AdminController;
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




Route::get('/users', [AdminController::class, 'showUsers'])->middleware('auth:sanctum');

Route::get('/judete', function (){
   return Judet::all();
});
