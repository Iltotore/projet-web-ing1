<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('application', [
	"page_to_load" => "home",
	"title" => "Accueil"
]);});
Route::get('/login', function () {return view('application', [
	"page_to_load" => "login",
	"title" => "Connexion"
]);});
Route::get('/about', function () {return view('application', [
	"page_to_load" => "about",
	"title" => "À propos"
]);});
Route::get('/cart', function () {
    Auth::login(User::find(2));
    return view('application', [
    "page_to_load" => "cart",
    "title" => "Mon panier"
]);});

Route::fallback(function () {return view('application', ["page_to_load" => "error", "title" => "Erreur"]);});

Route::post("/auth/login", [AuthController::class, "login"]);
Route::post("/auth/logout", [AuthController::class, "logout"]);
Route::post("/auth/register", [AuthController::class, "register"]);
Route::post("/auth/update", [AuthController::class, "update"])->middleware("auth");

Route::post("/cart/add", [CartController::class, "add"])->middleware("auth");
Route::post("/cart/remove", [CartController::class, "remove"])->middleware("auth");
Route::post("/cart/delete", [CartController::class, "delete"])->middleware("auth");
Route::post("/cart/clear", [CartController::class, "clear"])->middleware("auth");
Route::post("/cart/buy", [CartController::class, "buy"])->middleware("auth");

Route::post("/contact/create", [ContactController::class, "create"]);
Route::post("/contact/delete", [ContactController::class, "delete"]);
