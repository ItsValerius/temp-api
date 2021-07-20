<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureController;

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


Route::Post("/fileUpload",[TemperatureController::class,"store"]);
Route::get("/names",[TemperatureController::class,"index"]);
Route::get("/show/one",[TemperatureController::class,"show"]);
Route::get("/show/all",[TemperatureController::class,"showAll"]);
