<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TrucksController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/area", [AreasController::class, 'readAllAreas']);
});


//login
Route::post("/login", [AuthController::class, 'login']);
//Auth
Route::post("/register", [AuthController::class, 'register']);

//area
Route::post("/area", [AreasController::class, 'createArea']);
Route::get("/area", [AreasController::class, 'readAllAreas']);
Route::get("/area/{Id}", [AreasController::class, 'readArea']);
Route::get("/area", [AreasController::class, 'UpdateArea']);
Route::delete("/area", [AreasController::class, 'deleteArea']);

//driver
Route::post("/driver", [DriverController::class, 'createDriver']);
Route::get("/driver", [DriverController::class, 'readAllDrivers']);
Route::get("/driver/{id}", [DriverController::class, 'readDriver']);
Route::get("/driver", [DriverController::class, 'UpdateDriver']);
Route::delete("/driver", [DriverController::class, 'deleteDriver']);

//truck
Route::post("/truck", [TrucksController::class, 'createTruck']);
Route::get("/truck", [TrucksController::class, 'readAllTruck']);
Route::get("/truck/{id}", [TrucksController::class, 'readTruck']);
Route::get("/truck", [TrucksController::class, 'UpdateTruck']);
Route::delete("/truck", [TrucksController::class, 'deleteTruck']);