<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\CarboyController;
use App\Http\Controllers\CarboyOrderController;
use App\Http\Controllers\CarboyTypeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarDriverController;
use App\Http\Controllers\CarRouteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RouteController;


//por luis se necesita token
//Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);
Route::middleware('auth:sanctum')->get('/Carboy', [CarboyController::class, 'getUser']);
Route::middleware('auth:sanctum')->get('/CarboyOrder', [CarboyOrderController::class, 'getUser']);
Route::middleware('auth:sanctum')->get('/CarboyType', [CarboyTypeController::class, 'getUser']);

//Route::middleware('auth:sanctum')->get('/Car', [CarController::class, 'getUser']);

Route::middleware('auth:sanctum')->get('/CarDriver', [CarDriverController::class, 'getUser']);

Route::middleware('auth:sanctum')->get('/CarRoute', [CarRouteController::class, 'getUser']);

Route::middleware('auth:sanctum')->get('/Customer', [CustomerController::class, 'getUser']);


Route::middleware('auth:sanctum')->get('/Driver', [DriverController::class, 'getUser']);

Route::middleware('auth:sanctum')->get('/Order', [OrderController::class, 'getUser']);
Route::middleware('auth:sanctum')->get('/Route', [RouteController::class, 'getUser']);


//por luis no se necesita token
Route::post('/validar', [UserController::class, 'validarcorreo']);
Route::post('/userregister', [UserController::class, 'store']);


//por luis se necesita token
//listar todos los carros existentes
Route::middleware('auth:sanctum')->get('/getCar', [CarController::class, 'index']);
//eliminar un carro
Route::middleware('auth:sanctum')->delete('/deleteCar/{id}', [CarController::class, 'destroy']);
//actualizar carro
Route::middleware('auth:sanctum')->put('/updateCar/{id}', [CarController::class, 'update']);
//crear carro
Route::middleware('auth:sanctum')->post('/createCar', [CarController::class, 'store']);



