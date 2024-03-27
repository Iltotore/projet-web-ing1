<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return view('application', ["page_to_load" => "home"]);});
Route::get('/about', function () {return view('application', ["page_to_load" => "about"]);});
Route::get('/404_test', function () {return view('application');});

Route::post("/auth/login", [AuthController::class, "login"]);
Route::post("/auth/logout", [AuthController::class, "logout"]);
Route::post("/auth/register", [AuthController::class, "register"]);

Route::post("/cart/add", [CartController::class, "add"])->middleware("auth");
Route::post("/cart/remove", [CartController::class, "remove"])->middleware("auth");
Route::post("/cart/delete", [CartController::class, "delete"])->middleware("auth");
Route::post("/cart/clear", [CartController::class, "clear"])->middleware("auth");
Route::post("/cart/buy", [CartController::class, "buy"])->middleware("auth");
